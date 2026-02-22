<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SsoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SsoController extends Controller
{
    protected SsoService $ssoService;

    public function __construct(SsoService $ssoService)
    {
        $this->ssoService = $ssoService;
    }

    /**
     * Redirect to SSO login.
     */
    public function login()
    {
        // Generate state for CSRF protection
        $state = bin2hex(random_bytes(16));
        session(['sso_state' => $state]);

        return redirect($this->ssoService->getLoginUrl($state));
    }

    /**
     * Handle SSO callback.
     */
    public function callback(Request $request)
    {
        $token = $request->get('token');
        $state = $request->get('state');

        // Validate state (CSRF protection)
        $sessionState = session('sso_state');
        if ($state && $sessionState && $state !== $sessionState) {
            return redirect()->route('home')->with('error', 'Invalid state parameter');
        }

        // Clear state from session
        session()->forget('sso_state');

        if (!$token) {
            return redirect()->route('home')->with('error', 'No token received');
        }

        // Validate token with auth server
        $data = $this->ssoService->validateToken($token);

        if (!$data) {
            return redirect()->route('home')->with('error', 'Invalid or expired token');
        }

        // Find or create local user
        $user = User::findOrCreateFromSso($data['user']);

        // Log in the user
        Auth::login($user, true);

        return redirect()->route('dashboard')->with('success', 'Successfully logged in via SSO!');
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to SSO logout to logout from all apps
        return redirect($this->ssoService->getLogoutUrl(config('app.url')));
    }
}

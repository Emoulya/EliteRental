<?php
// app\Http\Controllers\Auth\AuthenticatedSessionController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect berdasarkan role dengan intended URL fallback
        return match ($user->role) {
            'admin' => $this->redirectAdmin($request),
            'user'  => $this->redirectUser($request),
            default => $this->redirectDefault($request)
        };
    }

    /**
     * Redirect untuk admin
     */
    protected function redirectAdmin(Request $request): RedirectResponse
    {
        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Redirect untuk user biasa
     */
    protected function redirectUser(Request $request): RedirectResponse
    {
        return redirect()->intended('/');
    }

    /**
     * Redirect default jika role tidak dikenali
     */
    protected function redirectDefault(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect('/login')
            ->with('error', 'Role tidak valid, silahkan hubungi administrator');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

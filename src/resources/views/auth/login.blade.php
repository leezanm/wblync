<x-guest-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .wb-login-shell {
             width: 100%;
            /* max-width: 980px; */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.9), transparent 22%),
                radial-gradient(circle at bottom right, rgba(255, 166, 77, 0.22), transparent 20%),
                linear-gradient(180deg, #f7f9fd 0%, #edf3fb 100%);
        }

        .wb-login-frame {
            width: 100%;
            max-width: 980px;
        }

        .wb-login-main {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(380px, 430px);
            overflow: hidden;
            /* border: 5px solid #101828; */
            border-radius: 28px;
              background:
                radial-gradient(circle at 15% 18%, rgba(255, 255, 255, 0.18), transparent 20%),
                radial-gradient(circle at 85% 88%, rgba(255, 171, 67, 0.28), transparent 18%),
                linear-gradient(135deg, #0459ea 0%, #1f75f6 58%, #6aa4ff 100%);

            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.22);
        }

        .wb-login-hero {
            position: relative;
            overflow: hidden;
            padding: 34px 30px 24px;
            color: #fff;
            /* background:
                radial-gradient(circle at 15% 18%, rgba(255, 255, 255, 0.18), transparent 20%),
                radial-gradient(circle at 85% 88%, rgba(255, 171, 67, 0.28), transparent 18%),
                linear-gradient(135deg, #0459ea 0%, #1f75f6 58%, #6aa4ff 100%); */
        }

        .wb-login-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            /* background-image:
                linear-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 34px 34px;
            mask-image: radial-gradient(circle at left center, black 40%, transparent 88%);
            pointer-events: none; */
        }

        .wb-login-hero > * {
            position: relative;
            z-index: 1;
        }

        .wb-login-brand img {
            width: auto;
            height: 76px;
        }

        .wb-login-copy {
            max-width: 290px;
            margin-top: 5px;
        }

        .wb-login-copy p:first-child {
            margin: 0 0 10px;
            font-size: 1rem;
            font-weight: 500;
            opacity: 0.96;
        }

        .wb-login-copy h1 {
            margin: 0;
            font-size: clamp(2.25rem, 5vw, 3.35rem);
            line-height: 0.9;
            letter-spacing: -0.05em;
            font-weight: 700;
        }

        .wb-login-copy h1 span {
            color: #ffb347;
        }

        .wb-login-copy p:last-child {
            margin: 10px 0 0;
            max-width: 220px;
            font-size: 0.88rem;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.92);
        }

        .wb-login-illustration {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 22px;
            margin-top: 5px;
            min-height: 200px;
        }

        .wb-login-illustration-art {
            width: min(100%, 500px);
            height: auto;
            flex: 0 0 auto;
            filter: drop-shadow(0 22px 32px rgba(7, 29, 90, 0.28));
        }

        .wb-login-hero-footer {
            max-width: 280px;
            padding-bottom: 12px;
            font-size: 0.95rem;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.95);
            /* justify-self: flex-center !important; */
        }

        .wb-login-copyright {
            margin-top: 18px;
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.76);
        }

        .wb-login-panel-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            /* background:
                radial-gradient(circle at 90% 100%, rgba(255, 165, 74, 0.48), transparent 17%),
                linear-gradient(180deg, #1a4987 0%, #eef4fb 100%); */
        }

        .wb-login-panel {
            width: 100%;
            max-width: 395px;
            border-radius: 16px;
            padding: 24px 24px 20px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(219, 226, 238, 0.95);
            box-shadow: 0 20px 40px rgba(26, 60, 122, 0.14);
        }

        .wb-login-panel img {
            display: block;
            margin: 0 auto;
            width: auto;
            height: 44px;
        }

        .wb-login-panel h2 {
            margin: 16px 0 6px;
            text-align: center;
            font-size: 1.28rem;
            line-height: 1.25;
            font-weight: 700;
            color: #16213b;
        }

        .wb-login-panel > p {
            margin: 0;
            text-align: center;
            font-size: 0.8rem;
            color: #6b7280;
        }

        .wb-login-form {
            margin-top: 18px;
        }

        .wb-login-alert {
            margin-bottom: 14px;
        }

        .wb-login-field {
            margin-bottom: 12px;
        }

        .wb-login-input-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 46px;
            padding: 0 13px;
            border: 1px solid #dbe2ee;
            border-radius: 9px;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .wb-login-input-wrap:focus-within {
            border-color: #1d67f5;
            box-shadow: 0 0 0 4px rgba(29, 103, 245, 0.12);
            transform: translateY(-1px);
        }

        .wb-login-input-wrap svg {
            width: 16px;
            height: 16px;
            color: #7b879a;
            flex: 0 0 auto;
        }

        .wb-login-input {
            width: 100%;
            border: 0;
            outline: 0;
            /* padding: 0; */
            box-shadow: none;
            background: transparent;
            color: #16213b;
            font-size: 0.84rem;
        }

        .wb-login-input::placeholder {
            color: #98a2b3;
        }

        .wb-login-toggle {
            display: inline-grid;
            place-items: center;
            padding: 0;
            border: 0;
            background: transparent;
            color: #7b879a;
            cursor: pointer;
        }

        .wb-login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 12px 0 14px;
            font-size: 0.76rem;
            color: #475467;
        }

        .wb-login-check {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .wb-login-check input {
            width: 14px;
            height: 14px;
            accent-color: #1d67f5;
        }

        .wb-login-link {
            color: #1d67f5;
            text-decoration: none;
            font-weight: 500;
        }

        .wb-login-link:hover {
            text-decoration: underline;
        }

        .wb-login-button {
            width: 100%;
            min-height: 42px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(180deg, #2571ff 0%, #0b61f4 100%);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 600;
            box-shadow: 0 16px 28px rgba(17, 93, 232, 0.22);
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .wb-login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 32px rgba(17, 93, 232, 0.26);
        }

        .wb-login-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 14px 0;
            color: #98a2b3;
            font-size: 0.74rem;
        }

        .wb-login-divider::before,
        .wb-login-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e4e9f2;
        }

        .wb-login-demo {
            border-radius: 10px;
            padding: 14px;
            background: linear-gradient(180deg, #f4f9ff 0%, #e9f2ff 100%);
            color: #334155;
        }

        .wb-login-demo-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .wb-login-demo-head svg {
            width: 20px;
            height: 20px;
            color: #1d67f5;
            flex: 0 0 auto;
        }

        .wb-login-demo-head h3 {
            margin: 0;
            font-size: 0.84rem;
            font-weight: 700;
            color: #16213b;
        }

        .wb-login-demo p {
            margin: 3px 0;
            font-size: 0.67rem;
            color: #475467;
        }

        @media (max-width: 991.98px) {
            .wb-login-main {
                grid-template-columns: minmax(250px, 0.95fr) minmax(320px, 1fr);
            }

            .wb-login-hero {
                padding: 28px 22px 22px;
            }

            .wb-login-copy {
                margin-top: 30px;
            }

            .wb-login-illustration {
                margin-top: 24px;
                min-height: 190px;
            }

            .wb-login-illustration-art {
                width: min(100%, 190px);
            }

            .wb-login-hero-footer {
                width: 135px;
                font-size: 0.82rem;
            }

            .wb-login-copyright {
                font-size: 0.58rem;
            }
        }

        @media (max-width: 767.98px) {
            .wb-login-shell {
                padding: 14px;
            }

            .wb-login-main {
                grid-template-columns: minmax(0, 1fr);
                border-width: 0;
                border-radius: 0;
                box-shadow: none;
                background: transparent;
            }

            .wb-login-hero {
                display: none;
            }

            .wb-login-panel-wrap {
                padding: 0;
                background: transparent;
            }

            .wb-login-panel {
                max-width: 430px;
                padding: 22px 20px 18px;
                border-radius: 18px;
            }

            .wb-login-options {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 479.98px) {
            .wb-login-shell {
                padding: 10px;
            }

            .wb-login-panel {
                padding: 18px 16px;
            }

            .wb-login-panel h2 {
                font-size: 1.15rem;
            }

            .wb-login-panel > p {
                font-size: 0.76rem;
            }
        }
    </style>

    <div class="wb-login-shell" x-data="{ showPassword: false }">
        <div class="wb-login-frame">
            <section class="wb-login-main">
                <div class="wb-login-hero">
                    <div class="wb-login-brand">
                        <img src="{{ asset('images/logo-putih4.png') }}" alt="WBLync">
                    </div>

                    <div class="wb-login-copy">
                        <p>Welcome to</p>
                        <h1>WBL<span>ync</span></h1>
                        <p>Smart Work-Based Learning Monitoring System</p>
                    </div>

                    <div class="wb-login-illustration" aria-hidden="true">
                        <img src="{{ asset('images/image-main.png') }}" alt="WBLync platform illustration" class="wb-login-illustration-art">
                    </div>
                      <div>
                            <div class="wb-login-hero-footer">Empowering Collaboration. Enhancing Future.</div>
                            <div class="wb-login-copyright">© 2026 WBLync. All rights reserved.</div>
                        </div>
                </div>

                <div class="wb-login-panel-wrap">
                    <div class="wb-login-panel">
                        <img src="{{ asset('images/logo-wblync.png') }}" alt="WBLync Logo">

                        <h2>Sign in to your account</h2>
                        <p>Please enter your credentials to continue.</p>

                        <x-auth-session-status class="wb-login-alert" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="wb-login-form">
                            @csrf

                            <div class="wb-login-field">
                                <label for="email" class="sr-only">Email address</label>
                                <div class="wb-login-input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                        <path d="m4 7 8 6 8-6"></path>
                                    </svg>
                                    <input id="email"
                                           name="email"
                                           type="email"
                                           value="{{ old('email') }}"
                                           required
                                           autofocus
                                           autocomplete="email"
                                           placeholder="Email address"
                                           class="wb-login-input">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="wb-login-field">
                                <label for="password" class="sr-only">Password</label>
                                <div class="wb-login-input-wrap">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="4" y="11" width="16" height="10" rx="2"></rect>
                                        <path d="M8 11V8a4 4 0 1 1 8 0v3"></path>
                                    </svg>
                                    <input id="password"
                                           name="password"
                                           x-bind:type="showPassword ? 'text' : 'password'"
                                           required
                                           autocomplete="current-password"
                                           placeholder="Password"
                                           class="wb-login-input">
                                    <button type="button" class="wb-login-toggle" x-on:click="showPassword = !showPassword" x-bind:aria-label="showPassword ? 'Hide password' : 'Show password'">
                                        <svg x-show="!showPassword" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        <svg x-show="showPassword" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m3 3 18 18"></path>
                                            <path d="M10.58 10.58A2 2 0 0 0 12 14a2 2 0 0 0 1.42-.58"></path>
                                            <path d="M9.88 5.09A10.94 10.94 0 0 1 12 5c6.5 0 10 7 10 7a18.73 18.73 0 0 1-2.1 2.87"></path>
                                            <path d="M6.61 6.61A18.7 18.7 0 0 0 2 12s3.5 7 10 7a9.77 9.77 0 0 0 4.24-.93"></path>
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="wb-login-options">
                                <label class="wb-login-check" for="remember_me">
                                    <input id="remember_me" type="checkbox" name="remember">
                                    <span>Remember me</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="wb-login-link">Forgot password?</a>
                                @endif
                            </div>

                            <button type="submit" class="wb-login-button">Login</button>

                            {{-- <div class="wb-login-divider">or</div>

                            <div class="wb-login-demo">
                                <div class="wb-login-demo-head">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M19 8v6"></path>
                                        <path d="M22 11h-6"></path>
                                    </svg>
                                    <h3>Demo Credentials</h3>
                                </div>
                                                         </div> --}}
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-guest-layout>

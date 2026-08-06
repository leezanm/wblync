<x-guest-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .wb-login-shell {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.22), transparent 24%),
                radial-gradient(circle at bottom right, rgba(247, 143, 32, 0.3), transparent 20%),
                linear-gradient(135deg, #0d5df1 0%, #1e7ff7 42%, #7eb2ff 100%);
            padding: 18px;
        }

        .wb-login-frame {
            max-width: 1440px;
            margin: 0 auto;
            display: grid;
            gap: 22px;
        }

        .wb-login-hero {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            padding: 28px;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(10, 85, 232, 0.94), rgba(94, 154, 250, 0.76)),
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.16), transparent 40%);
            box-shadow: 0 25px 80px rgba(15, 50, 135, 0.28);
        }

        .wb-login-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 36px 36px;
            mask-image: radial-gradient(circle at left center, black 35%, transparent 90%);
            pointer-events: none;
        }

        .wb-login-main {
            display: grid;
            gap: 18px;
        }

        .wb-login-brand,
        .wb-login-metrics,
        .wb-login-banner {
            position: relative;
            z-index: 1;
        }

        .wb-login-brand img {
            height: 80px;
            width: auto;
        }

        .wb-login-copy {
            max-width: 300px;
            margin-top: 8px;
        }

        .wb-login-copy p:first-child {
            margin: 0 0 10px;
            font-size: 1.65rem;
            font-weight: 600;
        }

        .wb-login-copy h1 {
            margin: 0;
            font-size: clamp(3rem, 6vw, 3.75rem);
            line-height: 0.85;
            font-weight: 700;
            letter-spacing: -0.04em;
        }

        .wb-login-copy h1 span {
            color: #ffb454;
        }

        .wb-login-copy p:last-child {
            margin: 18px 0 0;
            font-size: 1.2rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
        }

        .wb-login-illustration {
            position: relative;
            margin-top: 42px;
            min-height: 200px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
        }

        .wb-login-illustration-art {
            width: min(100%, 350px);
            height: auto;
            flex: 0 0 auto;
            filter: drop-shadow(0 24px 30px rgba(0, 28, 96, 0.24));
        }

        .wb-login-hero-footer {
            max-width: 220px;
            padding-bottom: 14px;
            font-size: 1.1rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.92);
        }

        .wb-login-copyright {
            margin-top: 18px;
            font-size: 0.75rem;
            color: rgba(209, 204, 204, 0.95);
        }

        .wb-login-panel-wrap {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wb-login-panel {
            width: 100%;
            max-width: 430px;
            border-radius: 22px;
            background: rgb(255, 255, 255);
            /* background: rgba(255, 255, 255, 0.94); */
            border: 1px solid rgba(255, 255, 255, 0.72);
            box-shadow: 0 22px 50px rgba(22, 51, 115, 0.24);
            backdrop-filter: blur(14px);
            padding: 24px;
        }

        .wb-login-panel img {
            height: 54px;
            width: auto;
            margin: 0 auto;
        }

        .wb-login-panel h2 {
            margin: 18px 0 6px;
            text-align: center;
            font-size: 1.55rem;
            font-weight: 700;
            color: #19233c;
        }

        .wb-login-panel > p {
            margin: 0;
            text-align: center;
            color: #5b6477;
            font-size: 0.95rem;
        }

        .wb-login-form {
            margin-top: 22px;
        }

        .wb-login-alert {
            margin-bottom: 16px;
        }

        .wb-login-field {
            margin-bottom: 14px;
        }

        .wb-login-input-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 54px;
            border-radius: 12px;
            border: 1px solid #d7dce8;
            background: #fff;
            padding: 0 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .wb-login-input-wrap:focus-within {
            border-color: #1f6fff;
            box-shadow: 0 0 0 4px rgba(31, 111, 255, 0.12);
        }

        .wb-login-input-wrap svg {
            width: 19px;
            height: 19px;
            color: #7f8aa3;
            flex: 0 0 auto;
        }

        .wb-login-input {
            width: 100%;
            border: 0;
            outline: 0;
            box-shadow: none;
            padding: 0;
            font-size: 0.96rem;
            color: #15213b;
            background: transparent;
        }

        .wb-login-input::placeholder {
            color: #9aa4b8;
        }

        .wb-login-toggle {
            border: 0;
            background: transparent;
            padding: 0;
            display: inline-grid;
            place-items: center;
            color: #7f8aa3;
            cursor: pointer;
        }

        .wb-login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin: 14px 0 18px;
            font-size: 0.88rem;
        }

        .wb-login-check {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #364152;
        }

        .wb-login-check input {
            width: 14px;
            height: 14px;
            accent-color: #1f6fff;
        }

        .wb-login-link {
            color: #1f6fff;
            text-decoration: none;
            font-weight: 500;
        }

        .wb-login-link:hover {
            text-decoration: underline;
        }

        .wb-login-button {
            width: 100%;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(180deg, #2571ff 0%, #0b61f4 100%);
            color: #fff;
            min-height: 48px;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            box-shadow: 0 16px 28px rgba(17, 93, 232, 0.24);
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .wb-login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 34px rgba(17, 93, 232, 0.28);
        }

        .wb-login-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 18px 0;
            color: #8e98ad;
            font-size: 0.85rem;
        }

        .wb-login-divider::before,
        .wb-login-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e3e8f1;
        }

        .wb-login-demo {
            border-radius: 14px;
            background: linear-gradient(180deg, #f4f9ff 0%, #eaf3ff 100%);
            padding: 16px;
            color: #334155;
        }

        .wb-login-demo-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .wb-login-demo-head svg {
            width: 22px;
            height: 22px;
            color: #1f6fff;
            flex: 0 0 auto;
        }

        .wb-login-demo-head h3 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
        }

        .wb-login-demo p {
            margin: 4px 0;
            font-size: 0.78rem;
        }

        .wb-login-highlights {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .wb-login-highlight,
        .wb-login-banner {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 18px 35px rgba(24, 46, 102, 0.12);
        }

        .wb-login-highlight {
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .wb-login-highlight-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(180deg, #eff5ff 0%, #dfeeff 100%);
            display: grid;
            place-items: center;
            color: #1f6fff;
            flex: 0 0 auto;
        }

        .wb-login-highlight-icon svg {
            width: 21px;
            height: 21px;
        }

        .wb-login-highlight strong {
            display: block;
            color: #1e293b;
            font-size: 0.96rem;
        }

        .wb-login-highlight span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 0.82rem;
            line-height: 1.45;
        }

        .wb-login-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 20px 24px;
        }

        .wb-login-banner-badge {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            background: linear-gradient(180deg, #eff5ff 0%, #dcecff 100%);
            display: grid;
            place-items: center;
            color: #1f6fff;
            flex: 0 0 auto;
        }

        .wb-login-banner-badge svg {
            width: 26px;
            height: 26px;
        }

        .wb-login-banner-copy {
            flex: 1;
        }

        .wb-login-banner-copy strong {
            display: block;
            color: #1e293b;
            font-size: 1.05rem;
        }

        .wb-login-banner-copy p {
            margin: 4px 0 0;
            color: #475569;
            line-height: 1.55;
        }

        .wb-login-banner-art {
            width: 120px;
            height: 68px;
            border-radius: 18px;
            background:
                radial-gradient(circle at 28% 30%, #ffb44d 0%, #ff8a00 38%, transparent 40%),
                radial-gradient(circle at 64% 26%, #57a6ff 0%, #1d6ef6 42%, transparent 44%),
                linear-gradient(180deg, #f2f8ff 0%, #e7f0ff 100%);
            position: relative;
            overflow: hidden;
            flex: 0 0 auto;
        }

        .wb-login-banner-art::before,
        .wb-login-banner-art::after {
            content: "";
            position: absolute;
            bottom: 12px;
            background: linear-gradient(180deg, #8dc0ff 0%, #4d8ef9 100%);
        }

        .wb-login-banner-art::before {
            left: 16px;
            width: 28px;
            height: 24px;
            border-radius: 8px 8px 4px 4px;
        }

        .wb-login-banner-art::after {
            right: 18px;
            width: 32px;
            height: 30px;
            border-radius: 10px 10px 4px 4px;
        }

        .wb-login-banner-art span {
            position: absolute;
            left: 10px;
            right: 10px;
            bottom: 10px;
            height: 2px;
            background: rgba(31, 111, 255, 0.2);
        }

        @media (min-width: 1024px) {
            .wb-login-shell {
                padding: 16px;
            }

            .wb-login-main {
                grid-template-columns: minmax(0, 1.1fr) minmax(380px, 430px);
                align-items: stretch;
                gap: 20px;
            }

            .wb-login-hero {
                min-height: 720px;
                padding: 30px 32px 18px;
            }

            .wb-login-panel-wrap {
                align-items: center;
            }

            .wb-login-panel {
                margin-right: 46px;
            }

            .wb-login-highlights {
                grid-template-columns: repeat(5, minmax(0, 1fr));
            }
        }

        @media (max-width: 1023.98px) {
            .wb-login-shell {
                padding: 14px;
            }

            .wb-login-hero {
                padding: 22px;
            }

            .wb-login-copy {
                margin-top: 24px;
                max-width: none;
            }

            .wb-login-illustration {
                margin-top: 28px;
                min-height: 0;
                flex-direction: column;
                align-items: flex-start;
            }

            .wb-login-hero-footer {
                max-width: none;
                padding-bottom: 0;
            }

            .wb-login-panel {
                max-width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .wb-login-hero,
            .wb-login-metrics {
                display: none;
            }

            .wb-login-frame {
                gap: 16px;
            }

            .wb-login-main {
                grid-template-columns: minmax(0, 1fr);
            }

            .wb-login-copy p:first-child {
                font-size: 1.15rem;
            }

            .wb-login-copy h1 {
                font-size: 3.25rem;
            }

            .wb-login-copy p:last-child {
                font-size: 1rem;
            }

            .wb-login-illustration-art {
                width: min(100%,230px);
            }

            .wb-login-panel {
                padding: 20px;
            }

            .wb-login-options {
                flex-direction: column;
                align-items: flex-start;
            }

            .wb-login-highlights {
                grid-template-columns: minmax(0, 1fr);
            }

            .wb-login-banner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 479.98px) {
            .wb-login-shell {
                padding: 10px;
            }

            .wb-login-hero {
                border-radius: 20px;
                padding: 18px;
            }

            .wb-login-panel {
                border-radius: 18px;
                padding: 16px;
            }

            .wb-login-copy h1 {
                font-size: 2.7rem;
            }

            .wb-login-demo p {
                font-size: 0.72rem;
            }
        }
    </style>

    <div class="wb-login-shell" x-data="{ showPassword: false }">
        <div class="wb-login-frame">
            <section class="wb-login-main">
                <div class="wb-login-hero">
                    <div class="wb-login-brand">
                        <img src="{{ asset('images/logo-putih4.png') }}" alt="WBLync" class="h-40">
                    </div>

                    <div class="wb-login-copy">
                        <p>Welcome to</p>
                        <h1>WBL<span>ync</span></h1>
                        <p>Smart Work-Based Learning Monitoring System</p>
                    </div>

                    <div class="wb-login-illustration" aria-hidden="true">
                        <img src="{{ asset('images/image-main.png') }}" alt="WBLync platform illustration" class="wb-login-illustration-art">

                        <div>
                            <div class="wb-login-hero-footer">Empowering Collaboration. Enhancing Future.</div>
                            <div class="wb-login-copyright">© 2026 WBLync. All rights reserved.</div>
                        </div>
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
                                           autocomplete="username"
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

                            <div class="wb-login-divider">or</div>

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
                                <p>student@wblync.com / password123</p>
                                <p>mentor@wblync.com / password123</p>
                                <p>lecturer@wblync.com / password123</p>
                                <p>admin@wblync.com / password123</p>
                            </div>
                        </form>
                    </div>
                </div>

            </section>
             <div class="wb-login-highlights">
                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="7" y="2" width="10" height="20" rx="2"></rect>
                                <path d="M11 18h2"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Mobile Friendly</strong>
                            <span>Responsive on all devices</span>
                        </div>
                    </article>

                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2 4 5v6c0 5 3.4 9.74 8 11 4.6-1.26 8-6 8-11V5l-8-3Z"></path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Secure</strong>
                            <span>Your data is protected</span>
                        </div>
                    </article>

                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="13.5" cy="6.5" r="2.5"></circle>
                                <circle cx="19" cy="17" r="2"></circle>
                                <circle cx="6" cy="12" r="3"></circle>
                                <path d="m8.6 10.5 2.8-2.2"></path>
                                <path d="m15.4 8.4 2 6.2"></path>
                                <path d="m8.8 13.4 8 2.5"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Modern UI</strong>
                            <span>Clean and intuitive design</span>
                        </div>
                    </article>

                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Fast & Reliable</strong>
                            <span>Optimized performance</span>
                        </div>
                    </article>

            <article class="wb-login-highlight">
                <div class="wb-login-banner-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2 4 5v6c0 5 3.4 9.74 8 11 4.6-1.26 8-6 8-11V5l-8-3Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </div>
                <div>                    <strong>Secure. Smart. Seamless.</strong>
                    <span>WBL management simpler, smarter, and more efficient.</span>
</div>

                {{-- <div class="wb-login-banner-copy">
                    <strong>Secure. Smart. Seamless.</strong>
                    <p>WBLync is designed to make Work-Based Learning management simpler, smarter, and more efficient.</p>
                </div> --}}

                {{-- <div class="wb-login-banner-art" aria-hidden="true">
                    <span></span>
                </div> --}}
            </article>

                </div>

            {{-- <section class="wb-login-metrics" aria-label="WBLync highlights">
                <div class="wb-login-highlights">
                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="7" y="2" width="10" height="20" rx="2"></rect>
                                <path d="M11 18h2"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Mobile Friendly</strong>
                            <span>Responsive on all devices</span>
                        </div>
                    </article>

                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2 4 5v6c0 5 3.4 9.74 8 11 4.6-1.26 8-6 8-11V5l-8-3Z"></path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Secure</strong>
                            <span>Your data is protected</span>
                        </div>
                    </article>

                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="13.5" cy="6.5" r="2.5"></circle>
                                <circle cx="19" cy="17" r="2"></circle>
                                <circle cx="6" cy="12" r="3"></circle>
                                <path d="m8.6 10.5 2.8-2.2"></path>
                                <path d="m15.4 8.4 2 6.2"></path>
                                <path d="m8.8 13.4 8 2.5"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Modern UI</strong>
                            <span>Clean and intuitive design</span>
                        </div>
                    </article>

                    <article class="wb-login-highlight">
                        <div class="wb-login-highlight-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z"></path>
                            </svg>
                        </div>
                        <div>
                            <strong>Fast & Reliable</strong>
                            <span>Optimized performance</span>
                        </div>
                    </article>
                </div>
            </section> --}}

            {{-- <section class="wb-login-banner">
                <div class="wb-login-banner-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2 4 5v6c0 5 3.4 9.74 8 11 4.6-1.26 8-6 8-11V5l-8-3Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </div>

                <div class="wb-login-banner-copy">
                    <strong>Secure. Smart. Seamless.</strong>
                    <p>WBLync is designed to make Work-Based Learning management simpler, smarter, and more efficient.</p>
                </div>


            </section> --}}
        </div>
    </div>
</x-guest-layout>

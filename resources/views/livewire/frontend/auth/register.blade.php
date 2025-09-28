<!-- ===============>> account start here <<================= -->
<section class="account padding-top padding-bottom sec-bg-color2">
    <div class="container">
        <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
            <div class="row g-4">
                <div class="col-12">
                    <div class="account__content account__content--style1">

                        <!-- account tittle -->
                        <div class="account__header">
                            <h2>Create Your Account</h2>
                            <p>Hey there! Ready to join the party? We just need a few details from you to get started. Let's do
                                this!</p>
                        </div>

                        <!-- account social -->
                        <!-- <div class="account__social">
                            <a href="#" class="account__social-btn"><span><img src="{{ url('assets/frontend/images/others/google.svg') }}"
                                        alt="google icon"></span>
                                Continue with google
                            </a>
                        </div> -->

                        <!-- account divider -->
                        <!-- <div class="account__divider account__divider--style1">
                            <span>or</span>
                        </div> -->

                        <!-- account form -->
                        <form wire:submit.prevent="register" class="account__form needs-validation" novalidate>
                            <div class="row g-4">
                                <div class="col-12 col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" wire:model="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Ex. John">
                                    @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" wire:model="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Ex. Doe">
                                    @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                    @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" wire:model="password_confirmation" class="form-control" placeholder="Re-type password">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Referral Code (Optional)</label>
                                    <input type="text" wire:model="refer_code" class="form-control @error('refer_code') is-invalid @enderror" placeholder="Enter referral code if you have one">
                                    @error('refer_code') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Sign Up</button>
                                </div>
                            </div>
                        </form>



                        <div class="account__switch">
                            <p>Don’t have an account yet? <a href="{{ route('login') }}" wire:navigate>Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="account__shape">
        <span class="account__shape-item account__shape-item--1"><img src="{{ url('assets/frontend/images/contact/4.png') }}"
                alt="shape-icon"></span>
    </div>
</section>
<!-- ===============>> account end here <<================= -->
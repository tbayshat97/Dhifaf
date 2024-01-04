{{-- <footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="/website/images/footer-logo.svg" alt="">
                    <footer-text></footer-text>
                </div>
                <div class="col-md-6">
                    <h4>{{__('layout.useful_links')}}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('about') }}" class="footer-links">{{__('layout.about_us')}}</a>
                            <a href="{{ route('privacy-policy') }}" class="footer-links">{{__('layout.privacy_policy')}}</a>
                            <a href="{{ route('terms-and-conditions') }}" class="footer-links">{{__('layout.terms_and_conditions')}}</a>
                            <a href="{{ route('return-policy') }}" class="footer-links">{{__('layout.return_policy')}}</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('sitemap') }}" class="footer-links">{{__('layout.site_map')}}</a>
                            <a href="{{ route('faqs') }}" class="footer-links">{{__('layout.faq')}}</a>
                            <a href="{{ route('contact-us') }}" class="footer-links">{{__('layout.contact')}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex align-items-center">
                            <h4>{{__('layout.follow_us')}}</h4>
                            <follow-component></follow-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="text-center">{{__('layout.copyright')}}</p>
    </div>
</footer> --}}

<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="widget widget-about">
                        <img class="footer-logo bg-transparent"
                            src="/website/images/footer-logo.svg">

                        <footer-text></footer-text>

                        <follow-component></follow-component>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('layout.useful_links') }}</h4>
                        <ul class="widget-list">
                            <li><a href="{{ route('about') }}"
                                    class="footer-links">{{ __('layout.about_us') }}</a></li>
                            <li><a href="{{ route('sitemap') }}"
                                    class="footer-links">{{ __('layout.site_map') }}</a></li>
                            <li><a href="{{ route('faqs') }}" class="footer-links">{{ __('layout.faq') }}</a></li>
                            <li><a href="{{ route('contact-us') }}"
                                    class="footer-links">{{ __('layout.contact') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-list">
                            <li><a href="{{ route('privacy-policy') }}"
                                    class="footer-links">{{ __('layout.privacy_policy') }}</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}"
                                    class="footer-links">{{ __('layout.terms_and_conditions') }}</a></li>
                            <li><a href="{{ route('return-policy') }}"
                                    class="footer-links">{{ __('layout.return_policy') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-list">
                            <li><a href="/login">{{ __('layout.login') }}</a></li>
                            <li><a href="/cart" class="">{{ __('layout.cart') }}</a></li>
                            <li><a href="/wishlist" class="">{{ __('layout.wishlist') }}</a></li>
                            <li><a href="/register" class="">{{ __('layout.register') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="pb-2 pt-2 container text-center">
            <p class="footer-copyright">Copyright © 1998-2021 Dhifaf-Baghdad Cosmetics Center Company.</p>
        </div>
    </div>
    <!---->
</footer>

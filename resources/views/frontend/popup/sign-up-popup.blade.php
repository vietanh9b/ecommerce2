{{-- <div class="dialog cpf-popup" tabindex="-1" id="sign-up-popup">
    <div class="popup_content cpf-popup-container d-flex flex-column">
        <div class="head_title cpf-popup-content__header">
            <button class="btn btn_close" data-dismiss="modal" aria-label="Close" type="button"></button>
        </div>
        <div class="cpf-popup-icon d-flex justify-content-center align-items-center h-100">
            <div class="cpf-popup-icon__circle d-flex justify-content-center align-items-center">
                <svg class="vector-exclamation-mark" width="11" height="44" viewBox="0 0 11 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.44617 28.78H1.58617L0.146172 0.159997H10.8862L9.44617 28.78ZM0.146172 38.8C0.146172 36.96 0.666172 35.68 1.70617 34.96C2.74617 34.2 4.00617 33.82 5.48617 33.82C6.92617 33.82 8.14617 34.2 9.14617 34.96C10.1862 35.68 10.7062 36.96 10.7062 38.8C10.7062 40.56 10.1862 41.84 9.14617 42.64C8.14617 43.4 6.92617 43.78 5.48617 43.78C4.00617 43.78 2.74617 43.4 1.70617 42.64C0.666172 41.84 0.146172 40.56 0.146172 38.8Z" fill="#008B43"/>
                </svg>
            </div>
        </div>
        <div class="cpf-popup-notice">
            <div class="cpf-popup-notice__body d-flex flex-column">
                <div class="cpf-popup-notice__title heading font-weight-bold">{{ __('Did you sign up yet?') }}</div>
                <div class="cpf-popup-notice__content mt-4">{{ __('Please login to continue !') }}</div>
            </div>
        </div>
        <div class="popup_footer cpf-popup-content__footer">
            <button class="btn sign-up-btn" type="button">{{ __('Go to login') }}</button>
        </div>
    </div>
</div> --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-0">
                <div class="icon-container" style="text-align: center;">
                    <svg class="vector-exclamation-mark" width="55" height="88" viewBox="0 0 11 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.44617 28.78H1.58617L0.146172 0.159997H10.8862L9.44617 28.78ZM0.146172 38.8C0.146172 36.96 0.666172 35.68 1.70617 34.96C2.74617 34.2 4.00617 33.82 5.48617 33.82C6.92617 33.82 8.14617 34.2 9.14617 34.96C10.1862 35.68 10.7062 36.96 10.7062 38.8C10.7062 40.56 10.1862 41.84 9.14617 42.64C8.14617 43.4 6.92617 43.78 5.48617 43.78C4.00617 43.78 2.74617 43.4 1.70617 42.64C0.666172 41.84 0.146172 40.56 0.146172 38.8Z" fill="#008B43"/>
                    </svg>
                </div>
                <div class="text-container" style="text-align: center;margin-top: 20px;">
                    <h5>Did you sign up yet ?</h5>
                    <p class="small-text" style="font-size: 15px;
                    color: #999;">Please login to continue!</p>
                </div>
            </div>
            <div class="modal-footer border-0" style="margin-right: 6%;" >
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary btn-medium text-uppercase me-3 mt-3">Go to login</button>
            </div>
        </div>
    </div>
</div>

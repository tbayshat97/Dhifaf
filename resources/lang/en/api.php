
<?php

return [
    'public' => [
        'done' => 'Process is successfully completed',
        'server_error' => 'Oops. Something went wrong. Please try again later.',
        'action_forbidden' => 'You are not allowed to perform this action',
        'no_data' => 'There is no data',
        'exist' => 'Already exists',
        'already_exist_plan' => 'Already added'
    ],
    'auth' => [
        'validation_error' => 'Error while validating',
        'invalid_route' => 'Invalid Route',
        'method_invalid' => 'Method Invalid',
        'related_resource' => 'The request could not be completed due to a conflict with the current state of the target resource.',
        'unauthinicated' => 'Unauthinicated, Session Expired',
        'login' => 'Loggedin successfully',
        'register' => 'Registered successfully',
        'verify_SMS_already' => 'Your mobile number already verified',
        'password-min' => 'The password must be at least 6 characters',
        'username-required' => 'The mobile number field is required',
        'password-required' => 'The password field is required',
        'rPassword-required' => 'The confirm password field is required',
        'verify_SMS_done' => 'Your mobile number is confirmed successfully',
        'resent_SMS_done' => 'Verification code sent successfully',
        'forget_password_config' => 'Verification code sent to your mobile number for reset your password',
        'loggedout' => 'Logged out successfully',
        'password_reset' => 'Your password has been reset successfully',
        'password_updated' => 'Your password has been updated successfully',
        'old_password_incorrect' => 'Your old password is incorrect',
        'code_sent_successfully' => 'Verification code sent successfully',
        'enter_verify_code' => 'Enter Verification Code',
        'verify_code_approved' => 'Verification code is approved',
        'invalid_credentials' => 'The mobile number or password you used are invalid. Please try again.',
        'invalid_cons' => 'The selected consultant and the code should be for the same peason',
        'not-acc' => 'Sorry your request not accepted yet'
    ],
    'verification' => [
        'valid' => 'Your mobile number is confirmed successfully',
        'invalid' => 'The verification code you entered is not valid',
        'maxAttempts ' => 'You have reached to max attempts to check a code',
    ],
    'order' => [
        'cancel' => 'Order Canceled',
        'coupon_expired' => 'The coupon you entered is not valid or has expired',
        'min_max' => 'You have ordered more than the allowed quantity for one of the products',
        'prevent_cancel' => 'Cannot cancel order',
        'already_taken' => 'This farm already taken by other customer on this date',
        'submit' => 'Order successfully submitted',
        'address' => 'You must add an address'
    ],
    'customer' => [
        'not_found' => 'customer not found',
    ],
    'driver' => [
        'not_found' => 'driver not found',
    ],
    'redeem' => [
        'limit' => 'you need more than 10 points to redeem',
    ],
    'social' => [
        'unable_login' => 'Unable to login using :service. Please try again',
    ],
    'tawseleh' => [
        'already_taken' => 'This order already taken by other driver',
    ],
    'anythingOrder' => [
        'already_taken' => 'This order already taken by other driver',
    ],
    'driverSchedule' => [
        'cannot_edit_old_value' => 'Unable to edit old Schedule',
    ],
];

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4EDF6;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #fff;
        }

        .header-container{
            background-color: #fff;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .header {
            background-color: transparent;
            text-align: center;
            padding: 12px 0px;
            font-size: 36px;
            font-weight: bold;
        }

        .header-title-1, .header-title-2 {
            display: inline-block;  /* Make both <p> elements inline-block */
            margin: 0;             /* Remove default paragraph margin */
        }

        .header-title-1{
            color: #A55AD9;
        }

        .header-title-2{
            color: #5A2982;
        }

        .order-message{
            background-color: transparent;
            font-size: 24px;
            font-weight: bold;
            color: #5C6C7B;
            padding-bottom:20px;
            text-align: center;
            margin: 20px 0;
        }

        .big-message {
            background-color: transparent;
            font-size: 42px;
            font-weight: bold;
            color: #A55AD9;
            padding-bottom:20px;
            text-align: center;
            margin: 20px 0;
        }

        .sub-message {
            background-color: transparent;
            text-align: center;
            font-size: 14px;
            color: #5C6C7B;
            margin-bottom: 30px;
        }

        /* Media query for screens smaller than 640px */
        @media (max-width: 640px) {
            .big-message {
                font-size: 32px; /* Adjust this value as needed */
            }
        }


        .card-table {
            width: 100%;
            border-spacing: 12px;
            border-collapse: separate;
            margin-bottom: 10px;
        }

        .card {
            text-align: center;
            padding: 20px;
            background-color: #B891D6;
            border: 1px solid #ddd;
            border-radius:12px;
            color: #F1F1F1;
        }


        .card.active{
            background-color: #A55AD9;
        }

        .card.active .card-icon{
            color:#FFFFFF;

        }

        .card-icon {
            font-size: 20px;
            color: #F1F1F1;
            margin-bottom: 10px;
        }

        /* Media query for screens smaller than 640px */
        @media (max-width: 640px) {
            .card {
                padding: 10px;
            }

            .card-icon {
                font-size: 12px;
            }
        }

        .track-button {
            display: block;
            width:200px;
            background-color: #A55AD9;
            color: white;
            text-align: center;
            padding: 20px 12px;
            text-decoration: none;
            font-weight: bold;
            font-size:16px;
            border-radius: 12px;
        }

        .order-details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details-table th,
        .order-details-table td {
            padding: 10px;
            border: 1px solid transparent;
        }

        .address-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .address-table td {
            padding:15px;
            background-color: #A55AD9;
            color:white;
        }

        .address-table .address-title{
            font-size:16px;
            font-weight:bold;
            margin:12px 0px;

        }
        .address-table .address-text{
            padding:0;
            margin:2px 0px;
        }

        .contact-table {
            width: 100%;
            border-collapse: collapse;
        }

        .contact-table .contact-table-cards{
            background-color: #F5E0FF;
            margin: 10px;
        }

        .contact-table .contact-table-cards td{
            padding: 10px;
            border-radius:15px 0px 0px 15px;
        }

        .contact-table .contact-table-cards .lastchild{
            border-radius:0px 15px 15px 0px;
        }

        .contact-table .contact-table-cards td p{
            margin: 0;
            padding: 6px 0px;
            color:#5C6C7B;
        }

        .contact-table .contact-table-cards td .contact-icon-wrapper {
            display: block;
            margin: 0 auto;
            text-align:center;
        }

        .contact-table .contact-table-cards td .contact-icon {
            width: 32px;
            height: 32px;
            background-color:#5A2982;
            border-radius:50%;
            padding:16px;
            color:#fff;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #666;
            background-color: #f8f9fa;
        }
        .footer .media-icon{
            display:inline-block;
            width:40px;
            height:40px;
            margin:0 6px;
            color:#5A2982;
        }


        /* Table Container */
        .order-details-table {
            width: 100%;
            text-align:left;
            color:#5A2982;
        }

        /* Table Row */
        .order-details-table .table-row {
            background-color: white;
            border-radius: 15px;
            border-bottom: 10px solid transparent;
        }

        /* Icon Cell */
        .order-details-table .table-cell-icon {
            text-align: center;
            border-radius: 15px 0px 0px 15px;
        }

        /* Icon Container */
        .order-details-table .icon-container {
            display: block;
            width: 100%;
            height: 100%;
            text-align: center;
            padding: 10px;
        }

        /* Icon SVG */
        .order-details-table .icon-svg {
            width: 50px;
            height: 50px;
            text-align: center;
            margin: auto;
        }

        /* Details Cell */
        .order-details-table .table-cell-details {
            text-align: left;
            font-size: 14px;
        }

        .order-details-table .table-cell-details p{
            padding:0px;
            margin:10px 0px;
        }

        /* Price Cell */
        .order-details-table .table-cell-price {
            text-align: right;
            border-radius: 0px 15px 15px 0px;
        }
    </style>
</head>

<body>

    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F4EDF6">
        <tr>
            <td align="center">
                <table class="container">
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="header-container">
                                <!-- Header -->
                                <tr>
                                    <td class="header"><a href="{{$link_home}}" target="_blank"><p class="header-title-1">Lan</p><p class="header-title-2">Ex</p></a></td>
                                </tr>

                                <!-- Big Message -->
                                <tr>
                                    <td class="big-message">{{ __($header_mail) }}</td>
                                </tr>

                                <!-- Order Number -->
                                <tr>
                                    <td class="order-message">{{ __($order_name) }}: {{$order_number}}</td>
                                </tr>

                                <!-- Sub Message -->
                                <tr>
                                    <td class="sub-message">
                                        {{ __($subheader_mail) }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    @if($type != 'cancellation')

                        <!-- Order Status Cards -->
                        <tr>
                            <td>
                                <table class="card-table">
                                    <tr>
                                        <td class="card {{$current_step == 'confirmed' ? 'active' : ''}}">
                                            <div class="card-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                                            </div>
                                            <strong>{{__($step_confirmed_label)}}</strong>
                                        </td>
                                        <td class="card {{$current_step == 'shipping' ? 'active' : ''}}">
                                            <div class="card-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                                            </div>
                                            <strong>{{__($step_shipping_label)}}</strong>
                                        </td>
                                        <td class="card {{$current_step == 'delivered' ? 'active' : ''}}">
                                            <div class="card-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/><path d="m7.5 4.27 9 5.15"/></svg>
                                            </div>
                                            <strong>{{__($step_delivered_label)}}</strong>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- Track Button -->
                        <tr>
                            <td style="text-align: center;">
                                <a href="{{$track_link}}" target="_blank" class="track-button" style="display: block; margin: 15px auto;">{{ __($track_btn) }}</a>
                            </td>
                        </tr>

                        <!-- Order Details -->
                        <tr style="background-color:#F4EDF6;">
                            <td style="border-radius:15px 15px 0px 0px; padding:15px; text-align:center;">
                                <p class="big-message">
                                    {{__($order_details_header)}}
                                </p>
                                <table class="order-details-table">
                                    @foreach ($order->freights as $freight)
                                        <tr class="table-row">
                                            <td class="table-cell-icon">
                                                <div class="icon-container">
                                                    <div class="icon-svg">
                                                        <img src="{{ env('APP_URL') . 'storage/public/images/mail/package.svg' }}" width="100%" height="100%" alt="Package Icon" />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="table-cell-details">
                                                <p><strong>{{$freight->name}}</strong></p>
                                                <p style="width:100%;"><strong>{{ __('messages.mail.common.details') }}</strong>: {{ $freight->description }}</p>

                                                <p><strong>{{ __('messages.mail.common.packages') }}</strong>:{{ $freight->packages }} {{ __('messages.mail.common.unit') }}.</p>

                                                <table style="display:inline-block; width:100%; padding:0; margin:0;">
                                                    <tr>
                                                        <td style="padding:0; margin:0" colspan="3"><strong>{{ __('messages.mail.common.characteristics') }}:</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding:0; margin:0" colspan="1">{{ __('messages.mail.common.weight') }}: {{$freight->weight}} {{$freight->weight_units}}</td>
                                                        <td style="padding:0 6px; margin:0" colspan="1">{{ __('messages.mail.common.length') }}: {{$freight->dimensions}} {{$freight->dimensions_units }}</td>
                                                        <td style="padding:0; margin:0" colspan="1">{{ __('messages.mail.common.volume') }}: {{$freight->volume}} {{$freight->volume_units}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="table-cell-price">
                                                <p>S/.1200.00</p>
                                            </td>
                                        </tr>
                                        <tr class="table-row" style="height:20px; background-color:transparent">
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr style="background-color:#F4EDF6;">
                            <td style="border-radius:0px 0px 15px 15px; padding:15px">
                                <table class="address-table">
                                    <tr style="border-radius:15px;">
                                        <td style="border-radius:15px 0px 0px 15px;">
                                            <p class="address-title">{{__($shipping_address)}}</p>
                                            <p class="address-text">Peru</p>
                                            <p class="address-text">Lima</p>
                                            <p class="address-text">Av Lima 1224 Pando</p>
                                        </td>
                                        <td style="border-radius:0px 15px 15px 0px;">
                                            <p class="address-title">{{__($billing_address)}}</p>
                                            <p class="address-text">{{$order->getLastTrackStep()->country}}</p>
                                            <p class="address-text">{{$order->getLastTrackStep()->city}}</p>
                                            <p class="address-text">{{$order->getLastTrackStep()->address}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif


                    <!-- Contact Section -->
                    <tr>
                        <td>
                            <table class="contact-table">
                                <colgroup>
                                    <col style="width: 50%">
                                    <col style="width: 50%">
                                </colgroup>
                                <tr>
                                    <td class="big-message" style="width:100%; padding-top:40px;" colspan="2">
                                        {{__($questions_header)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="sub-message" style="width:100%; padding-bottom:40px;" colspan="2">
                                        {{__($questions_subheader)}}
                                    </td>
                                </tr>
                                <tr class="contact-table-cards">
                                    <td colspan="1">
                                        <table>
                                            <colgroup>
                                                <col style="width: 30%">
                                                <col style="width: 70%">
                                            </colgroup>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <div class="contact-icon-wrapper">
                                                        <div class="contact-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail">
                                                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p><strong>{{__($email_us)}}</strong></p>
                                                    <p>support@lanex.com</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                    <td colspan="1" class="lastchild">
                                        <table style="width:100%;">
                                            <colgroup>
                                                <col style="width: 30%">
                                                <col style="width: 70%">
                                            </colgroup>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <div class="contact-icon-wrapper">
                                                        <div class="contact-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p><strong>{{__($contact_us)}}</strong></p>
                                                    <p>support@lanex.com</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="background-color:white; padding:20px 0px; height:40px; width:100%;">
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <div style="text-align:center; width:100%;">
                                <a href="{{$instagram_link}}" target="_blank" class="media-icon">
<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
                                <a href="{{$facebook_link}}" target="_blank" class="media-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                                <a href="{{$linkedin_link}}" target="_blank" class="media-icon">
<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                                </a>
                            </div>
                            <p>
                                {{__($footer_header)}}
                            </p>
                            <p>{{__($footer_description)}}</p>
                            <p>&copy; 2024 LanEx. {{__($footer_rights_reserved)}}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
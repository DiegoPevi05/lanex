<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Illuminate\Support\Facades\App;  // Import this for locale handling

class OrderStatusMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $order;
    public $type;
    public $header_mail;
    public $subheader_mail;

    /**Footer texts **/
    public $instagram_link;
    public $facebook_link;
    public $linkedin_link;

    public $current_step;

    //Custom Email Fields
    public $withDetails;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     * @param string $type
     * @param string $language
     */
    public function __construct(Order $order, string $type = 'confirmation', $language = 'es',$subject, $title, $content, $withDetails)
    {
        // Set the application's locale to the passed language
        App::setLocale($language);

        $this->order = $order;
        $this->type = $type;
        $this->setMailPlaceholders($type,$subject, $title, $content, $withDetails);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.order_status')
                    ->subject(trans($this->subject))
                    ->with([
                        'type' => $this->type,
                        'withDetails' => $this->withDetails,
                        'order' => $this->order,
                        'link_home' => 'https://www.lanexsac.com',
                        'header_mail' => trans($this->header_mail),
                        'subheader_mail' => trans($this->subheader_mail),
                        'order_name' => trans('messages.mail.common.order_name'), // Translate here
                        'order_number' => $this->order->order_number,
                        'current_step' => $this->current_step,
                        'step_confirmed_label' => trans('messages.mail.common.step_confirmed_label'),
                        'step_shipping_label' => trans('messages.mail.common.step_shipping_label'),
                        'step_delivered_label' => trans('messages.mail.common.step_delivered_label'),
                        'track_link' => url('/track') . '?order=' . $this->order->order_number,
                        'track_btn' => trans('messages.mail.common.track_btn'),
                        'order_details_header' => trans('messages.mail.common.order_details_header'),
                        'shipping_address' => trans('messages.mail.common.shipping_address'),
                        'billing_address' => trans('messages.mail.common.billing_address'),
                        'questions_header' => trans('messages.mail.common.questions_header'),
                        'questions_subheader' => trans('messages.mail.common.questions_subheader'),
                        'contact_us' => trans('messages.mail.common.contact_us'),
                        'email_us' => trans('messages.mail.common.email_us'),
                        'instagram_link' => 'https://www.instagram.com/expresslanelogisticssac',
                        'facebook_link' => 'https://www.facebook.com/profile.php?id=61566765038948',
                        'linkedin_link' => 'https://www.linkedin.com/company/expresslane-logistics-s-a-c/',
                        'footer_header' => trans('messages.mail.common.footer_header'),
                        'footer_description' => trans('messages.mail.common.footer_description'),
                        'footer_rights_reserved' => trans('messages.mail.common.footer_rights_reserved')
                    ]);
    }

    protected function setMailPlaceholders(string $type,$subject, $title, $content, $withDetails)
    {
        switch ($type) {
            case 'confirmation':
                $this->header_mail = trans('messages.mail.status.confirmation_header');
                $this->subheader_mail = trans('messages.mail.status.confirmation_subheader');
                $this->subject = trans('messages.mail.status.confirmation_subject');
                $this->current_step = 0;
                $this->withDetails = true;
                break;
            case 'shipping':
                $this->header_mail = trans('messages.mail.status.shipping_header');
                $this->subheader_mail = trans('messages.mail.status.shipping_subheader');
                $this->subject = trans('messages.mail.status.shipping_subject');
                $this->current_step = 1;
                $this->withDetails = true;
                break;
            case 'delivered':
                $this->header_mail = trans('messages.mail.status.delivered_header');
                $this->subheader_mail = trans('messages.mail.status.delivered_subheader');
                $this->subject = trans('messages.mail.status.delivered_subject');
                $this->current_step = 2;
                $this->withDetails = true;
                break;
            case 'cancellation':
                $this->header_mail = trans('messages.mail.status.cancellation_header');
                $this->subheader_mail = trans('messages.mail.status.cancellation_subheader');
                $this->subject = trans('messages.mail.status.cancellation_subject');
                $this->current_step = 0;
                $this->withDetails = false;
                break;
            case 'custom':
                $this->header_mail = $title;
                $this->subheader_mail = $content;
                $this->subject = $subject;
                $this->current_step = 0;
                $this->withDetails = $withDetails;
                break;
            default:
                $this->header_mail = trans('messages.mail.status.default_header');
                $this->subheader_mail = trans('messages.mail.status.default_subheader');
                $this->subject = trans('messages.mail.status.default_subject');
                $this->current_step = 1;
                $this->withDetails = true;
                break;
        }
    }
}

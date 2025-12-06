<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter; // Spatie Newsletter (Mailchimp)
use Mail;
use Botble\Newsletter\Models\Newsletter as NewsletterModel; // Botble Newsletter Model

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // 1. Lưu vào DB nội bộ Botble (nếu chưa tồn tại)
        if (!NewsletterModel::where('email', $email)->exists()) {
            NewsletterModel::create([
                'email' => $email,
                'status' => 'subscribed', // hoặc 'pending' tuỳ theo luồng
            ]);
        }

        // 2. Lưu vào Mailchimp
        if (!Newsletter::isSubscribed($email)) {
            Newsletter::subscribePending($email); // pending = gửi mail xác nhận (double opt-in)
        }

        // 3. Gửi mail cảm ơn khách hàng
        Mail::raw('Cảm ơn bạn đã đăng ký nhận tin từ chúng tôi!', function ($message) use ($email) {
            $message->to($email)->subject('Đăng ký thành công');
        });

        // 4. Gửi mail báo cho admin
        Mail::raw("Có một subscriber mới: $email", function ($message) {
            $message->to('admin@yourshop.com')->subject('Subscriber mới');
        });

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công, vui lòng kiểm tra email để xác nhận!'
        ]);
    }
}

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <h2 style="margin-bottom: 24px;">{{ $mail->subject }}</h2>

            <p style="margin: 0; font-size: 16px; line-height: 1.5;">{!! nl2br($mail->body) !!}</p>
            @if($mail->action_text && $url)
                <p style="text-align: center; margin: 32px 0;">
                    <a href="{{ $url }}" style="display:inline-block; padding:12px 24px; background:#3869d4; color:#fff; text-decoration:none; border-radius:4px; font-weight:bold;">
                        {{ $mail->action_text }}
                    </a>
                </p>
            @endif

            <hr style="margin: 32px 0;">
            <p style="color: #999;">このメールに心当たりがない場合は、破棄してください。</p>
        </td>
    </tr>
</table>
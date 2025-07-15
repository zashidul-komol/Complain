@component('mail::button', ['url' => 'mailto:'.$data['complainant_email']])
Reply to {{$data['complainant_email']}}
@endcomponent
প্রিয় সহকর্মী,<br><br>
পন্যের মান উন্নয়নে নিরলশভাবে কাজ করার জন্য আপনাকে পোলার আইসক্রীম পরিবারের পক্ষ থেকে ধন্যবাদ। <br>
আপানাকে জানানো যাছে যে, {{$data['complain_date']}} মিনিটে একটি নতুন অভিযোগ/পরামর্শ প্রেরিত হয়েছে। এই বিষয়ে বিস্তারিত দেখতে নিম্নলিখিত লিংকে ক্লিক করুন। <br><br>
https://complain.polarbd.com/customerComplains/view_customer_complain/{{$data['id']}}<br><br>
আপনাকে উক্ত অভিযোগের বিষয়ে পুরোপুরি অবহিত হয়ে, আগামী পাঁচ (৫) কার্যদিবসের মধ্যে যথাযথ উত্তর প্রদানের ব্যবস্থা গ্রহণ করার জন্য বিনীতভাবে অনুরোধ করা যাচ্ছে।<br><br>

ধন্যবাদান্তে<br>
বিপণন ও ভোক্তা সন্তুষ্টি বিভাগ।<br>
ঢাকা আইসক্রীম ইন্ডাস্ট্রিজ লিমিটেড।

<br><br>
<a href='https://www.polarbd.com' target=_blank><img src="{{asset('storage/images/PolarLogoBangla.png')}}" border=0 alt='www.polarbd.com'></a><br><br>



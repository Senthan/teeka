@extends('emails.layout')
@section('title')
   Teeka Libaray
@endsection
@section('content')
    <div style="padding: 10px;">
        @if(isset($template))
            @if(isset($images) && count($images))
                @php
                $htmlContents = [];
                $lastContent = null;
                @endphp
                @foreach($images as $key => $image)
                    @php
                    $tag = "<new-img img='$image'>";
                        $templateTmpArray = explode($tag, $template);
                        $templateTmpArrayCount = count($templateTmpArray);
                        if ($templateTmpArrayCount && $templateTmpArrayCount == 2) {
                        $htmlContents[$image . ":" . $key] = $templateTmpArray[0] ?? '';
                        $lastContent = $templateTmpArray[1] ?? '';
                        $template = str_replace($templateTmpArray[0] . $tag, "", $template) ?? '';
                        }elseif ($templateTmpArrayCount && $templateTmpArrayCount > 2) {
                        foreach ($templateTmpArray as $k => $templateTmp) {
                        if ($k + 1 == $templateTmpArrayCount) {
                        $lastContent = $templateTmp;
                        }else {
                        $htmlContents[$image . ":" . $k] = $templateTmp ?? '';
                        }
                        }
                        }
                        @endphp
                        @endforeach
                        @foreach($htmlContents as $key => $htmlContent)
                            @php
                            $imageWithKey = explode(':', $key);
                            $image = $imageWithKey[0];
                            @endphp
                            {!! $htmlContent !!}
                            <img style="max-width: 100%" src="{!! $message->embed(storage_path($image)) !!}" >
                        @endforeach
                        {!! $lastContent !!}
                        @else
                            {!! $template !!}
                    @endif
                    @endif
    </div>
@stop
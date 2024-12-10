@extends( getThemePath() . '.layout.master')

@section('title', $page->meta_title ? $page->meta_title .' '. getSetting('tab_separator') .' '.
getSetting('system_title') : $page->title .' '. getSetting('tab_separator') .' '.
getSetting('system_title'))
@section('seo_description', $page->meta_description)

@section('header')
@include( getThemePath() . '.partials.header')
@endsection

@section('content')
<section class="section-white">
    <div class="content-wrap">
        <div class="col">
            <h1 class="page-title">{{ $page->title }}</h1>
        </div> <!-- col -->
        <div class="col-one-third icon-box-dark">
            <i class="fa fa-2x fa-phone" aria-hidden="true"></i>
            <h2>Call Us</h2>
            <p><a href="tel:{{ getSetting('contact_phone') }}">{{ getSetting('contact_phone') }}</a></p>
        </div>
        <div class="col-one-third icon-box-dark">
            <i class="fa fa-2x fa-envelope" aria-hidden="true"></i>
            <h2>Email Us</h2>
            <p><a href="mailto:{{ getSetting('contact_email') }}">{{ getSetting('contact_email') }}</a></p>
        </div>
        <div class="col-one-third icon-box-dark">
            <i class="fa fa-2x fa-life-ring" aria-hidden="true"></i>
            <h2>Request Support</h2>
            <p><a href="/support">Submit Ticket</a></p>
        </div>
        <div class="col-half">
            {!! $page->content !!}
        </div> <!-- col-half -->
        <div class="col-half">
            @include( getThemePath() . '.notifications')

            {{-- Ajax Notifications --}}
            <div class="qp-notification qp-success hidden"></div>
            <div class="qp-notification qp-error hidden"></div>

            <!-- form start -->
            {{-- <form method="POST" action="/contact-us-ajax" class="qp-form" role="form">
                {{ csrf_field() }} --}}
                <form method="POST" action="" class="qp-form" role="form">
                    <div class="qp-form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="qp-form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Your Email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="qp-form-group">
                        <label for="msg">Message</label>
                        <textarea name="msg" class="form-control" id="message"
                            placeholder="Your Message">{{ old('msg') }}</textarea>
                    </div>
                    <div class="qp-form-group">
                        <button type="submit" name="SendMessage" class="btn" id="SendMessage">Send
                            Message</button>
                    </div>
                </form>
        </div> <!-- qp-row -->
    </div> <!-- qp-page-content -->
    </div> <!-- content-wrap -->
</section> <!-- section-white -->
@endsection

@section('footer')
@include( getThemePath() . '.partials.footer')
@endsection

@section('scripts')
<script>
    $( document ).ready(function() {

        $.ajaxSetup({            
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
                
        $('#SendMessage').click( function (e) {
            e.preventDefault();

            $('#SendMessage').attr('disabled','disabled');
            $('.qp-success').children().remove();
            $('.qp-error').children().remove();
            $('.qp-success').addClass('hidden');
            $('.qp-error').addClass('hidden');

            var name = $("input[name=name]").val();
            var email = $("input[name=email]").val();
            var msg = $("#message").val();
            let data = { name: name, email: email, msg: msg};

            $.ajax({
                type:'post',
                url:"{{ route('contact.us.ajax') }}",
                dataType: 'json',
                data:{
                    name:name,
                    email:email,
                    msg:msg
                },
                success:function(data) {
                    // console.log(data);
                    $('#SendMessage').removeAttr("disabled");
                    $('.qp-success').removeClass("hidden");
                    $('.qp-success').addClass("block");
                    var successDiv = '<p>' + data.message + '</p>';                                                    
                    $('.qp-success').append(successDiv);
                    $("input[name=name]").val("");
                    $("input[name=email]").val("");
                    $("#message").val("");                
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var data = jqXHR.responseJSON;
                    $('#SendMessage').removeAttr("disabled");
                    // console.log(data.errors);// this will be the error bag.
                    $('.qp-error').removeClass("hidden");
                    $('.qp-error').addClass("block");

                    if( data.errors.name ) {
                        var nameDiv = '<p>' + data.errors.name + '</p>';
                        $('.qp-error').append(nameDiv);
                    }
                    if( data.errors.email ) {
                        var emailDiv = '<p>' + data.errors.email + '</p>';
                        $('.qp-error').append(emailDiv);
                    }
                    if( data.errors.msg ) {
                        var msgDiv = '<p>' + data.errors.msg + '</p>';
                        $('.qp-error').append(msgDiv);
                    }
                }
            });
        });
    });
</script>
@stop
<!-- Social icons -->
<div class="pt-3 bg-blue-dark border-top border-warning font-20">
    @if(!empty($socials))
        @foreach($socials as $social)
            <a href="{{ $social->url }}" target="_blank">
                <i class="fab fa-{{ $social->icon }} font-24 mr-3"></i>
            </a>
        @endforeach
    @endif
</div>
<!-- Social icons -->

<!--Copyright-->
<div class="footer-copyright pb-3 bg-blue-dark py-3">
    © 2018 <a href="javascript:;" class="gibson-bold color-yellow-dark ml-3" target="_blank"> SINDIRECEITA DF</a>
</div>
<!--/.Copyright-->
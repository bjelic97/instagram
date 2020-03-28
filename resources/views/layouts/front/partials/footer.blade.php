</div>
<footer>
    <div class="footer-section">
        <div class="social-links-warp">
            <div class="container">
                <div class="social-links">
                    <a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a>
                    <a href="{{url('/register')}}"><i class="fa fa-unlock-alt"
                                                      aria-hidden="true"></i><span>Sign up</span></a>
                    <a href="{{url('/login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i><span>Sign in</span></a>
                    <a href="{{url('/author')}}"><i class="fa fa-user-circle"
                                                    aria-hidden="true"></i><span>Author</span></a>
                    <a href="{{url('/')}}"><i class="fa fa-file-text"
                                              aria-hidden="true"></i><span>Documentation</span></a>

                </div>
            </div>
        </div>
    </div>
</footer>
{{--<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>--}}


{{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
<script src="{{asset('/js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{asset('/js/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.2/dist/latest/bootstrap-autocomplete.min.js"></script>
</body>
</html>

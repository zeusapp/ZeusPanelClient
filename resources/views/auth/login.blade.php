<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Zeus</title>
    <link rel="stylesheet" href="{{asset("assets/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <style>
        canvas {

            position: absolute;
            top: 0;
            left: 0;
            background-color: black;
        }
    </style>

</head>

<body class="">
<canvas id=c style="width: 100vw; height: 100vh;"></canvas>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10" >
            <div class="card shadow-lg o-hidden border-0 my-5" style="background-color: rgba(0, 0, 0, 0.5) !important;">
                <div class="card-body p-0" style="background-color: rgba(0, 0, 0, 0) !important;">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image"
                                 style="background: url({{asset("assets/img/8.png")}}) no-repeat center; background-size: 90%;"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-light mb-4">Welcome Back!</h4>
                                </div>
                                @if($errors->count() > 0)
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf
                                    <div class="form-group"><input
                                            class="form-control form-control-user @error('username') is-invalid @enderror"
                                            type="text" id="username" aria-describedby="username"
                                            placeholder="Username" name="login"></div>
                                    <div class="form-group"><input
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            type="password" id="password" placeholder="Password"
                                            name="password"></div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <div class="form-check">
                                                <input class="form-check-input custom-control-input" type="checkbox"
                                                       name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}><label
                                                    class="form-check-label custom-control-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block text-white btn-user" type="submit">Login
                                    </button>
                                    <hr>
                                </form>
                                @if (Route::has('password.request'))
                                    <div class="text-center"><a class="small"
                                                                href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                    </div>
                                @endif
                                <div class="text-center"><a class="small" href="{{ route('register') }}">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="{{asset("assets/js/script.min.js")}}"></script>
<script>
    var w = c.width = window.innerWidth,
        h = c.height = window.innerHeight,
        ctx = c.getContext( '2d' ),

        minDist = 10,
        maxDist = 30,
        initialWidth = 10,
        maxLines = 100,
        initialLines = 4,
        speed = 5,

        lines = [],
        frame = 0,
        timeSinceLast = 0,

        dirs = [
            // straight x, y velocity
            [ 0, 1 ],
            [ 1, 0 ],
            [ 0, -1 ],
            [ -1, 0 ],
            // diagonals, 0.7 = sin(PI/4) = cos(PI/4)
            [ .7, .7 ],
            [ .7, -.7 ],
            [ -.7, .7 ],
            [ -.7, -.7]
        ],
        starter = { // starting parent line, just a pseudo line

            x: w / 2,
            y: h / 2,
            vx: 0,
            vy: 0,
            width: initialWidth
        };

    function init() {

        lines.length = 0;

        for( var i = 0; i < initialLines; ++i )
            lines.push( new Line( starter ) );

        ctx.fillStyle = '#222';
        ctx.fillRect( 0, 0, w, h );

        // if you want a cookie ;)
        // ctx.lineCap = 'round';
    }
    function getColor( x ) {

        return 'hsl( hue, 80%, 50% )'.replace(
            'hue', x / w * 360 + frame
        );
    }
    function anim() {

        window.requestAnimationFrame( anim );

        ++frame;

        ctx.shadowBlur = 0;
        ctx.fillStyle = 'rgba(0,0,0,.02)';
        ctx.fillRect( 0, 0, w, h );
        ctx.shadowBlur = .5;

        for( var i = 0; i < lines.length; ++i )

            if( lines[ i ].step() ) { // if true it's dead

                lines.splice( i, 1 );
                --i;

            }

        // spawn new

        ++timeSinceLast

        if( lines.length < maxLines && timeSinceLast > 10 && Math.random() < .5 ) {

            timeSinceLast = 0;

            lines.push( new Line( starter ) );

            // cover the middle;
            ctx.fillStyle = ctx.shadowColor = getColor( starter.x );
            ctx.beginPath();
            ctx.arc( starter.x, starter.y, initialWidth, 0, Math.PI * 2 );
            ctx.fill();
        }
    }

    function Line( parent ) {

        this.x = parent.x | 0;
        this.y = parent.y | 0;
        this.width = parent.width / 1.25;

        do {

            var dir = dirs[ ( Math.random() * dirs.length ) |0 ];
            this.vx = dir[ 0 ];
            this.vy = dir[ 1 ];

        } while (
            ( this.vx === -parent.vx && this.vy === -parent.vy ) || ( this.vx === parent.vx && this.vy === parent.vy) );

        this.vx *= speed;
        this.vy *= speed;

        this.dist = ( Math.random() * ( maxDist - minDist ) + minDist );

    }
    Line.prototype.step = function() {

        var dead = false;

        var prevX = this.x,
            prevY = this.y;

        this.x += this.vx;
        this.y += this.vy;

        --this.dist;

        // kill if out of screen
        if( this.x < 0 || this.x > w || this.y < 0 || this.y > h )
            dead = true;

        // make children :D
        if( this.dist <= 0 && this.width > 1 ) {

            // keep yo self, sometimes
            this.dist = Math.random() * ( maxDist - minDist ) + minDist;

            // add 2 children
            if( lines.length < maxLines ) lines.push( new Line( this ) );
            if( lines.length < maxLines && Math.random() < .5 ) lines.push( new Line( this ) );

            // kill the poor thing
            if( Math.random() < .2 ) dead = true;
        }

        ctx.strokeStyle = ctx.shadowColor = getColor( this.x );
        ctx.beginPath();
        ctx.lineWidth = this.width;
        ctx.moveTo( this.x, this.y );
        ctx.lineTo( prevX, prevY );
        ctx.stroke();

        if( dead ) return true
    }

    init();
    anim();

    window.addEventListener( 'resize', function() {

        w = c.width = window.innerWidth;
        h = c.height = window.innerHeight;
        starter.x = w / 2;
        starter.y = h / 2;

        init();
    } )
</script>
</body>

</html>

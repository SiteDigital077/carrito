@extends ('LayoutsSD.Layout')



         <script type="text/javascript" src="/validaciones/vendor/jquery/jquery.min.js"></script>

          @section('cabecera')
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Site Digital">
    <meta http-equiv="Cache-control" content="public">
    <title></title>


    @foreach($seo as $seo)
    <link rel="canonical" href="{{$seo->canonical}}{{Request::getRequestUri()}}"/>
    <meta property="og:locale" content="{{$seo->idioma}}">
    <meta property="og:type" content="{{$seo->og_type}}">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:url" content="{{$seo->og_url}}">
    <meta property="og:site_name" content="{{$seo->og_name}}">
    <meta property="og:image" content="{{$seo->canonical}}/{{$seo->og_image}}">
    <meta name="twitter:card" content="{{$seo->twitter_card}}"/>
    <meta name="twitter:site" content="{{$seo->twitter_site}}" />
    <meta name="twitter:creator" content="{{$seo->twitter_creator}}" />
    <meta name="twitter:title" content="{{$seo->twitter_title}}" />
    <meta name="twitter:description" content="{{$seo->twitter_description}}" />
    <meta name="twitter:image" content="{{$seo->twitter_image}}" />
    <link rel="shortcut icon" href="{{$seo->ico}}" type="image/icon">
    <link rel="apple-touch-icon" href="{{$seo->icoapple}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.css" crossorigin="anonymous">
<style>
/*zoomIn.css*/
.zoomit-ghost {
  top: 0;
  left: 0;
  z-index: 10;
  width: 100%;
  height: 100%;
  cursor: wait;
  display: block;
  position: absolute;
  -webkit-user-select: none;
  -webkit-touch-callout: none;
}
.zoomit-zoomed {
  top: 0;
  left: 0;
  opacity: 0;
  z-index: 5;
  position: absolute;
  width: auto !important;
  height: auto !important;
  max-width: none !important;
  max-height: none !important;
  min-width: 100% !important;
  min-height: 100% !important;
  transition: transform 0.1s ease, opacity 0.2s ease;
}
.zoomit-container {
  overflow: hidden;
  position: relative;
  vertical-align: top;
  display: inline-block;
}
.zoomit-container img {
  vertical-align: top;
}
.zoomit-container.loaded .zoomit-ghost {
  cursor: crosshair;
}
.zoomit-container.loaded .zoomit-zoomed {
  opacity: 1;
}

</style>
    @endforeach
 
  @stop
    @section('ContenidoSite-01')


<div class="container" style="padding: 10px 0px 30px 0px">
<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
<div class="test">
  <img id="pic" src="/{{ $product->image }}" class="img-responsive center-block" data-zoomed="/{{ $product->image }}" alt="zoom in pic">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
  <br>
   <h3>{{$product->name}}</h3>
   <br>
   @if($product->precioivafin == $product->precioinivafin)
 <div class="product-price-and-shipping">                              
  <span class="sr-only">Price</span>
  <span itemprop="price" class="price has_discount" style="font-size:25px"><strong>$ {{number_format($product->precioinivafin,0,",",".")}}</strong></span>
 </div>
@else
 <div class="product-price-and-shipping">
  <span class="sr-only">Regular price</span>
  <span class="price regular-price" style="font-size:18px">$ {{number_format($product->precioivafin,0,",",".")}}</span>
  <span class="price discount-percentage"><strong>-5%</strong></span>
  <span class="sr-only">Price</span>
  <span itemprop="price" class="price has_discount text-primary" style="font-size:25px"><strong>$ {{number_format($product->precioinivafin,0,",",".")}}</strong></span>
 </div>
@endif
<br>
<p>Precio en Pesos Colombianos COP</p>

<br>
<p class="text-justify">{!!$product->contenido!!}</p>
<br>
@if($product->position == 0)
<span class="text-success"> Hay Existencias</span>
@else
<span class="text-danger"> No Hay Existencias</span>
@endif
<br><br>

<a href="{{URL::previous()}}" class="btn btn-default btn-lg">Regresar al catálogo</a>
@if($product->position == 0)
<a href="{{ route('cart-add', $product->slug)}}" class="btn btn-primary btn-lg">Agregar al carrito</a>
@else
<a class="btn btn-danger btn-lg" disabled>No disponible</a>
@endif
<br><br>
<p>
Categoria:
@foreach($categoriapro as $categoriapro)
@if($categoriapro->id == $product->categoriapro_id)
{{$categoriapro->nombre}} <strong>//</strong>  
@endif
@endforeach
@foreach($categoriessd as $categoriessd)
@if($categoriessd->id == $product->category_id)
<span style="color:{{$categoriessd->color}}">{{$categoriessd->name}}</span>
@endif
@endforeach
</p>
<br>
@if($product->pinterest == '')
@else
<a href="{{$product->pinterest}}" target="_blank" style="background: #bb081d; padding:12px 15px;border-radius: 5px; color: #fff"><i class="fab fa-pinterest-p"></i></a>
@endif
@if($product->facebook == '')
@else
<a href="{{$product->facebook}}" target="_blank" style="background: #4267b2; padding:12px 16px;border-radius: 5px; color: #fff"><i class="fab fa-facebook-f"></i></a>
@endif
@if($product->instagram == '')
@else
<a href="{{$product->instagram}}" target="_blank" style="background: #9d36c1; padding:12px 16px;border-radius: 5px; color: #fff"><i class="fab fa-instagram"></i></a>
@endif
@if($product->youtube == '')
@else
<a href="{{$product->youtube}}" target="_blank" style="background: #ff0000; padding:12px;border-radius: 5px; color: #fff"><i class="fab fa-youtube"></i></a>
@endif
</div>
</div>

<style type="text/css">
  .product-grid{
    font-family: 'Poppins', sans-serif;
    box-shadow: 0px 3px 8px -4px rgba(0, 0, 0, 0.15);
}
.product-grid .product-image{
    position: relative;
    overflow: hidden;
}
.product-grid .product-image:before{
    content: "";
    background: rgba(255, 255, 255, 0.75);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: -100%;
    z-index: 0;
    transition: all 0.2s linear 0s;
}
.product-grid .product-image:hover:before{
   opacity: 1;
   left: 0;
}
.product-grid .product-image a.image{ display: block; }
.product-grid .product-image img{
    width: 100%;
    height: auto;
}
.product-grid .product-new-label{
    color: #fff;
    background: #a9af89;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    padding: 5px 11px;
    border-radius: 30px;
    opacity: 1;
    position: absolute;
    top: 10px;
    right: 10px;
    transition: all .3s linear;
}
.product-grid .product-image:hover .product-new-label{ opacity: 0; }
.product-grid .social{
    padding: 0;
    margin: 0;
    list-style: none;
    transform: translateX(-50%) translateY(-50%);
    position: absolute;
    top: 50%;
    left: 50%;
}
.product-grid .social li{
    margin: 0 3px;
    display: inline-block;
    transform: scale(0);
    transition: all 0.3s;
}
.product-grid .social li:first-child{ transition-delay: 0.1s; }
.product-grid .social li:last-child{ transition-delay: 0.2s; }
.product-grid .product-image:hover .social li{ transform: scale(1); }
.product-grid .social li a{
    color: #fff;
    background: #212529;
    font-size: 20px;
    text-align: center;
    line-height: 44px;
    height: 44px;
    width: 44px;
    border-radius: 50px;
    display: block;
    transition: all 0.3s linear 0s;
}
.product-grid .social li a:hover{ background-color: #a9af89; }
.product-grid .product-content{
    padding: 12px;
    text-align: center;
}
.product-grid .title{
    font-size: 17px;
    font-weight: 600;
    text-transform: capitalize;
    margin: 0 0 7px;
}
.product-grid .title a{
    color: #666;
    transition: all 0.3s ease;
}
.product-grid .title a:hover{ color: #a9af89; }
.product-grid .price{
    color: #444;
    font-size: 19px;
    font-weight: 600;
}
.product-grid .price span{
    color: #9e9e9e;
    font-size: 16px;
    font-weight: 500;
    text-decoration: line-through;
    margin-right: 5px;
    display: inline-block;
}
.fa-shopping-bag{padding-top: 10px}
.fa-search{padding-top: 10px}
@media screen and (max-width:990px){
    .product-grid{ margin: 0 0 30px; }
}
</style>
<div class="container">
<div class="row">
 
       @foreach($products as $product)
      @if($product->position == '1')
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                 
                        <img class="pic-1 img-responsive" src="/{{$product->image}}">
                        <span style="margin-top:-190px; position: absolute; margin-left:0px; text-align: center; color: #000; font-weight:bold; background: white; padding: 20px 100px">AGOTADO</span>
                   
                </div>
                <div class="product-content">
                    <h3 class="title text-primary"><a class="text-primary" href="#"><span class="text-primary">{{$product->name}}</span></a></h3>
                    <div class="price">${{number_format($product->precioinivafin,0,",",".")}}</div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="#" class="image">
                        <img class="pic-1 img-responsive" src="/{{$product->image}}">
                    </a>
                    <ul class="social">
                        <li><a href="{{ route('cart-add', $product->slug)}}"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="{{ route('product-detail', $product->slug)}}"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
                <div class="product-content">
                    <h3 class="title text-primary"><a class="text-primary" href="#"><span class="text-primary">{{$product->name}}</span></a></h3>
                    <div class="price">${{number_format($product->precioinivafin,0,",",".")}}</div>
                </div>
            </div>
        </div>
        @endif
            @endforeach
              </div>
</div>

       

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.js"></script>
<script type="text/javascript">
  //zoomIn.js
(function(factory) {
  if (typeof define === "function" && define.amd) {
    define(["jquery"], factory);
  } else {
    factory(jQuery);
  }
})(function($) {
  $.fn.zoomIt = function(options) {
    // Default parameters
    var defaults = {
      enabled: 1,
      status: 0,
      loaded: 0,
      img: $(this),
      offset: [0, 0],
      class: {
        container: "zoomit-container",
        loaded: "loaded",
        img: "zoomit-zoomed",
        ghost: "zoomit-ghost"
      },
      // Get image src
      src: function() {
        return this.img.data("zoomed");
      },
      // Get zoom image src
      getSrc: function() {
        return typeof this.src == "function" ? this.src() : this.src;
      },
      // Image HTML
      imgTag: null
    };

    // Merge options
    options = $.extend(defaults, options);

    // Execute Callback
    options.execute = function(e) {
      if (typeof e === "string" && typeof options[e] === "function") {
        options[e](options);
      }
    };

    // Get container
    options.getContainer = function() {
      return $('<div class="' + options.class.container + '"></div>');
    };

    // Get zoom image src
    options.getImgSrc = function() {
      if (options.imgTag === null) {
        options.imgTag = $("<img />")
          .addClass(options.class.img)
          .attr("src", this.getSrc());

        // Alt Tag
        if (typeof options.img.attr("alt") !== "undefined") {
          options.imgTag.attr("alt", options.img.attr("alt"));
        }
      }

      return options.imgTag;
    };

    // Get zoomed image instance
    options.getZoomInstance = function() {
      return options.img.parent().find("." + options.class.img);
    };

    // Restrict a numerical value between 0 and 1
    options.restrict = function(val) {
      if (val > 1) {
        val = 1;
      } else if (val < 0) {
        val = 0;
      }

      return val;
    };

    // Get image dimensions
    options.getDimensions = function() {
      // Set position
      options.position = {
        img: {
          width: options.img.width(),
          height: options.img.height(),
          offset: options.img.offset()
        },
        zoom: {
          width: options.getZoomInstance().width(),
          height: options.getZoomInstance().height()
        }
      };
    };

    // Position zoomed image element
    options.setPosition = function(event) {
      // iOS Original Event (Pointer Position)
      if (typeof event.originalEvent !== "undefined") {
        event = event.originalEvent;
      }

      // Get image dimensions
      if (options.loaded === 0) {
        options.getDimensions();
      }

      // Add loaded class
      options.img.parent().addClass(options.class.loaded);
      options.loaded = 1;

      // Percentages
      options.position.x = options.restrict(
        (event.pageX - options.position.img.offset.left) /
          options.position.img.width
      );
      options.position.y = options.restrict(
        (event.pageY - options.position.img.offset.top) /
          options.position.img.height
      );

      // Offsets
      options.position.zoom.offset = {
        left:
          (options.position.zoom.width - options.position.img.width) *
          options.position.x,
        top:
          (options.position.zoom.height - options.position.img.height) *
          options.position.y
      };

      options.getZoomInstance().css({
        transform:
          "translate(-" +
          options.position.zoom.offset.left +
          "px, -" +
          options.position.zoom.offset.top +
          "px)"
      });
    };

    // Show zoom
    options.show = function(event) {
      // Return early if image is loading
      if (!options.enabled || (options.status === 1 && options.loaded === 0)) {
        return;
      }

      // Set zoom status
      options.status = 1;

      // Append image
      if (options.img.parent().find("." + options.class.img).length == 0) {
        options.img.after(options.getImgSrc());

        // Image loaded callback
        options
          .getZoomInstance()
          .on("load", function() {
            options.setPosition(event);
          })
          .each(function() {
            if (this.complete) options.setPosition(event);
          });
      } else {
        options.setPosition(event);
      }

      // onZoomIn
      options.execute("onZoomIn");
    };

    // Hide zoom
    options.hide = function() {
      options.status = 0;
      options.loaded = 0;
      options.imgTag = null;
      options.img.parent().removeClass(options.class.loaded);
      setTimeout(function() {
        options.getZoomInstance().remove();
      }, 500);
      options.getZoomInstance().remove();

      // onZoomOut
      options.execute("onZoomOut");
    };

    // Move zoom
    options.move = function(event) {
      if (options.status) {
        options.show(event);
      }
    };

    // Enable
    options.enable = function() {
      options.enabled = 1;
    };

    // Disable
    options.disable = function() {
      options.enabled = 0;
    };

    // Initialize
    options.init = function() {
      options.img
        .wrap(options.getContainer())
        .after('<div class="' + options.class.ghost + '"></div>');

      // Ghost
      options.ghost = options.img.parent().find("." + options.class.ghost);

      // Mouse events
      options.ghost
        .on("mouseenter touchstart", function(event) {
          options.show(event);
        })
        .on("mouseleave touchend", function() {
          options.hide();
        })
        .on("mousemove touchmove", function(event) {
          event.stopPropagation();
          event.preventDefault();
          options.move(event);
        })
        .on("click", function() {
          options.execute("onClick");
        });

      // onInit
      options.execute("onInit");
    };

    // Bind zoom data
    options.img.data("zoom", options);
    options.init();
  };
});

//apply
$("#pic").zoomIt({
  onClick:function(){
    alert("good luck");
  }
});

</script>

@stop

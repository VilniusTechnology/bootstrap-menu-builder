![alt tag](https://travis-ci.org/VilniusTechnology/bootstrap-menu-builder.svg)
![alt tag](https://scrutinizer-ci.com/g/VilniusTechnology/bootstrap-menu-builder/badges/quality-score.png?b=master)

# Bootstrap menu builder


## Installation

` composer require vilnius-technology/bootstrap-menu-builder dev-master`

## Usage example for Laravel

### Prepare your template

``` html

    <!DOCTYPE html>
    <html>
        <head>
            <title>Bootstrap menu builder with laravel</title>
            <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    
        </head>
        <body>
            <div class="container">
    
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Test menu title
                                <span class="caret"></span>
                            </a>
                            {!! $menu  !!}
                        </li>
                    </ul>
                </div>

                <div class="content">
                    <div class="title">Bootstrap menu builder with laravel</div>
                </div>
            </div>
        </body>
    </html>
```

### Implement menu building in your controller

``` php
    <?php
    
    namespace App\Http\Controllers;
    
    use VilniusTechnology\BootstrapMenuBuilder\BootstrapMenuBuilder;
    use VilniusTechnology\BootstrapMenuBuilder\EntryObject;
    use VilniusTechnology\BootstrapMenuBuilder\MenuListObject;
    
    class TestController extends Controller
    {
        public function test()
        {
            $text = new EntryObject('id1', 'parent1', 'Url1_', 'Title 1');
            $text2 = new EntryObject('id2', 'parent2', 'Url2_', 'Title 2' );
    
            $list = new MenuListObject('Menu List', [$text2, $text]);
    
            $contents = [
                    $text,
                    $list,
                    $text2,
            ];
    
            $bmb = new BootstrapMenuBuilder(true);
            $menu = $bmb->buildMenu($contents);
    
            return view('welcome', ['menu' => $menu]);
        }
    }
```

### CSS
If You are using older bootstrap versions, You migh need to add this CSS:
```css
    div.collapse {
        overflow: visible;
        font-family: 'Open Sans', sans-serif;
        text-transform: uppercase;
    }
    
    .dropdown-submenu {
        position:relative;
        font-size: 9px;
        font-weight: normal;
        line-height: 0.9;
    }
    
    .dropdown .caret {
        margin-left: 7px;
    }
    
    ul.dropdown-menu {
        -webkit-border-radius:0;
        -moz-border-radius:0;
        border-radius:0;
    }
    
    li.dropdown-submenu a {
        font-weight: 400;
    }
    
    .dropdown-submenu > .dropdown-menu {
        top:0;
        left:100%;
        margin-top:-6px;
        margin-left:-1px;
        -webkit-border-radius:0;
        -moz-border-radius:0;
        border-radius:0;
    }
    
    .dropdown-submenu:hover > .dropdown-menu{
        display:block;
    }
    
    .dropdown-submenu > a:after{
        display:block;
        content:" ";
        float:right;
        width:0;
        height:0;
        border-color:transparent;
        border-style:solid;
        border-width:5px 0 5px 5px;
        border-left-color:#cccccc;
        margin-top:5px;
        margin-right:-15px;
        margin-left: 10px;
    }
    
    .dropdown-submenu:hover > a:after{
        border-left-color:#ffffff;
    }
    
    .dropdown-submenu .pull-left{
        float:none;
    }
    
    .dropdown-submenu.pull-left > .dropdown-menu{
        left:-100%;
        margin-left:10px;
        -webkit-border-radius:6px 0 6px 6px;
        -moz-border-radius:6px 0 6px 6px;
        border-radius:6px 0 6px 6px;
    }
    
    .root:hover > .dropdown-menu{
        display: block;
    }
```


## API

    `$bmb = new BootstrapMenuBuilder(true);`
    
    `$bmb->createRoot();`
    
### Sub menu 

Is represented by class: `MenuListObject()`.
It accepts params:


### Menu entry
Is represented by `EntryObject()`.
It accepts params:

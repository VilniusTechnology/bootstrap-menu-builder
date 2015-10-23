![alt tag](https://travis-ci.org/VilniusTechnology/bootstrap-menu-builder.svg)
![alt tag](https://scrutinizer-ci.com/g/VilniusTechnology/bootstrap-menu-builder/badges/quality-score.png?b=master)

# Bootstrap menu builder


## Installation

`composer require [ ... ] `

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

## API

    `$bmb = new BootstrapMenuBuilder(true);`
    
### Sub menu 

Is represented by class: `MenuListObject()`.
It accepts params:


### Menu entry
Is represented by `EntryObject()`.
It accepts params:

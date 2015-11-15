<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/partials/nav.htm */
class __TwigTemplate_ffca01e29235f0e0a40efd05221cffa1c674de19e9b3a197cd45e5a2d12fdc8f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["links"] = array("home" => array(0 => "home", 1 => "Home"), "pages" => array("name" => "Pages", "sublinks" => array("about" => array(0 => "samples/about", 1 => "About Us"), "contact" => array(0 => "samples/contact", 1 => "Contact Us"))), "blog" => array("name" => "Blog", "sublinks" => array("blog" => array(0 => "blog/blog", 1 => "Blog"), "post" => array(0 => "blog/post", 1 => "Blog Post"))), "ui-elements" => array(0 => "ui-elements", 1 => "UI Elements"));
        // line 23
        echo "
";
        // line 44
        echo "
";
        // line 45
        $context["nav"] = $this;
        // line 46
        echo "
<nav id=\"layout-nav\" class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
    <div class=\"container\">
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-main-collapse\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"";
        // line 56
        echo $this->env->getExtension('CMS')->pageFilter("home");
        echo "\">Flat</a>
        </div>
        <div class=\"collapse navbar-collapse navbar-main-collapse\">
            <ul class=\"nav navbar-nav navbar-right\">
                ";
        // line 60
        echo $context["nav"]->getrender_menu((isset($context["links"]) ? $context["links"] : null));
        echo "
                <li>
                    <button
                        onclick=\"window.location='";
        // line 63
        echo $this->env->getExtension('CMS')->pageFilter("samples/signin");
        echo "'\"
                        class=\"btn btn-sm navbar-btn btn-primary navbar-right hidden-sm hidden-xs\">
                        Sign in
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>";
    }

    // line 24
    public function getrender_menu($__links__ = null)
    {
        $context = $this->env->mergeGlobals(array(
            "links" => $__links__,
            "varargs" => func_num_args() > 1 ? array_slice(func_get_args(), 1) : array(),
        ));

        $blocks = array();

        ob_start();
        try {
            // line 25
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["links"]) ? $context["links"] : null));
            foreach ($context['_seq'] as $context["code"] => $context["link"]) {
                // line 26
                echo "        <li class=\"";
                echo ((($context["code"] == (isset($context["currentPage"]) ? $context["currentPage"] : null))) ? ("active") : (""));
                echo " ";
                echo (($this->getAttribute($context["link"], "sublinks", array())) ? ("dropdown") : (""));
                echo "\">
            <a
                href=\"";
                // line 28
                echo (($this->getAttribute($context["link"], "sublinks", array())) ? ("#") : ($this->env->getExtension('CMS')->pageFilter((($this->getAttribute($context["link"], "page", array())) ? ($this->getAttribute($context["link"], "page", array())) : ($this->getAttribute($context["link"], 0, array(), "array"))))));
                echo "\"
                ";
                // line 29
                if ($this->getAttribute($context["link"], "sublinks", array())) {
                    echo "data-toggle=\"dropdown\"";
                }
                // line 30
                echo "                class=\"";
                echo (($this->getAttribute($context["link"], "sublinks", array())) ? ("dropdown-toggle") : (""));
                echo "\"
            >
                ";
                // line 32
                echo twig_escape_filter($this->env, (($this->getAttribute($context["link"], "name", array())) ? ($this->getAttribute($context["link"], "name", array())) : ($this->getAttribute($context["link"], 1, array(), "array"))), "html", null, true);
                echo "
                ";
                // line 33
                if ($this->getAttribute($context["link"], "sublinks", array())) {
                    echo "<span class=\"caret\"></span>";
                }
                // line 34
                echo "            </a>
            ";
                // line 35
                if ($this->getAttribute($context["link"], "sublinks", array())) {
                    // line 36
                    echo "                <span class=\"dropdown-arrow\"></span>
                <ul class=\"dropdown-menu\">
                    ";
                    // line 38
                    echo $this->getAttribute($this, "render_menu", array(0 => $this->getAttribute($context["link"], "sublinks", array())), "method");
                    echo "
                </ul>
            ";
                }
                // line 41
                echo "        </li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['code'], $context['link'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/partials/nav.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 41,  123 => 38,  119 => 36,  117 => 35,  114 => 34,  110 => 33,  106 => 32,  100 => 30,  96 => 29,  92 => 28,  84 => 26,  79 => 25,  67 => 24,  54 => 63,  48 => 60,  41 => 56,  29 => 46,  27 => 45,  24 => 44,  21 => 23,  19 => 2,);
    }
}
/* {# Note: Only one levels of sublinks are supported by Bootstrap 3 #}*/
/* {% set*/
/*     links = {*/
/*         'home': ['home', 'Home'],*/
/*         'pages': {*/
/*             name: 'Pages',*/
/*             sublinks: {*/
/*                 'about':         ['samples/about', 'About Us'],*/
/*                 'contact':       ['samples/contact', 'Contact Us'],*/
/*             },*/
/*         },*/
/*         'blog': {*/
/*             name: 'Blog',*/
/*             sublinks: {*/
/*                 'blog': ['blog/blog', 'Blog'],*/
/*                 'post': ['blog/post', 'Blog Post'],*/
/*             },*/
/*         },*/
/*         'ui-elements': ['ui-elements', 'UI Elements'],*/
/* */
/*     }*/
/* %}*/
/* */
/* {% macro render_menu(links) %}*/
/*     {% for code, link in links %}*/
/*         <li class="{{ code == currentPage ? 'active' }} {{ link.sublinks ? 'dropdown' }}">*/
/*             <a*/
/*                 href="{{ link.sublinks ? '#' : (link.page ?: link[0])|page }}"*/
/*                 {% if link.sublinks %}data-toggle="dropdown"{% endif %}*/
/*                 class="{{ link.sublinks ? 'dropdown-toggle' }}"*/
/*             >*/
/*                 {{ link.name ?: link[1] }}*/
/*                 {% if link.sublinks %}<span class="caret"></span>{% endif %}*/
/*             </a>*/
/*             {% if link.sublinks %}*/
/*                 <span class="dropdown-arrow"></span>*/
/*                 <ul class="dropdown-menu">*/
/*                     {{ _self.render_menu(link.sublinks) }}*/
/*                 </ul>*/
/*             {% endif %}*/
/*         </li>*/
/*     {% endfor %}*/
/* {% endmacro %}*/
/* */
/* {% import _self as nav %}*/
/* */
/* <nav id="layout-nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">*/
/*     <div class="container">*/
/*         <div class="navbar-header">*/
/*             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">*/
/*                 <span class="sr-only">Toggle navigation</span>*/
/*                 <span class="icon-bar"></span>*/
/*                 <span class="icon-bar"></span>*/
/*                 <span class="icon-bar"></span>*/
/*             </button>*/
/*             <a class="navbar-brand" href="{{ 'home'|page }}">Flat</a>*/
/*         </div>*/
/*         <div class="collapse navbar-collapse navbar-main-collapse">*/
/*             <ul class="nav navbar-nav navbar-right">*/
/*                 {{ nav.render_menu(links) }}*/
/*                 <li>*/
/*                     <button*/
/*                         onclick="window.location='{{ 'samples/signin'|page }}'"*/
/*                         class="btn btn-sm navbar-btn btn-primary navbar-right hidden-sm hidden-xs">*/
/*                         Sign in*/
/*                     </button>*/
/*                 </li>*/
/*             </ul>*/
/*         </div>*/
/*     </div>*/
/* </nav>*/

<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/pages/code-testing.htm */
class __TwigTemplate_57770ba7bf9ba563b49365b584dd9d1fee09727fe9a18798718d8441157b0f1f extends Twig_Template
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
        // line 1
        echo "<section class=\"home-title\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-sm-12\">
                <!--<h3>Monitoring websites for price changes</h3>
                <p>You have a product that needs monitoring? Give it to us and we'll notify you when the price drops.</p>
                -->
            </div>
        </div>
    </div>
</section>

<div class=\"container\">
    ";
        // line 14
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("ProductAdd"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 15
        echo "    <div class=\"panel panel-default\">
        \t<div class=\"panel-heading\">Categories</div>
        </div>
        <div class=\"panel-body\">
            ";
        // line 19
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("ProductCategories"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 20
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/pages/code-testing.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 20,  44 => 19,  38 => 15,  34 => 14,  19 => 1,);
    }
}
/* <section class="home-title">*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-sm-12">*/
/*                 <!--<h3>Monitoring websites for price changes</h3>*/
/*                 <p>You have a product that needs monitoring? Give it to us and we'll notify you when the price drops.</p>*/
/*                 -->*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <div class="container">*/
/*     {% component 'ProductAdd' %}*/
/*     <div class="panel panel-default">*/
/*         	<div class="panel-heading">Categories</div>*/
/*         </div>*/
/*         <div class="panel-body">*/
/*             {% component 'ProductCategories' %}*/
/*         </div>*/
/*     </div>*/
/* </div>*/

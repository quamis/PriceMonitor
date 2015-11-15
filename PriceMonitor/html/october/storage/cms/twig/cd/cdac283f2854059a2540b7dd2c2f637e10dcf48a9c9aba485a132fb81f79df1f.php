<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/pages/history.htm */
class __TwigTemplate_dedf657ddd2ec603660369a483a1630dace54ce00df05fcd96ea0bb192d173ba extends Twig_Template
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
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("breadcrumbs"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 2
        echo "
<div class=\"container\">
    <h4>History for ";
        // line 4
        $context['__cms_component_params'] = [];
        $context['__cms_component_params']['showTitle'] = 1        ;
        echo $this->env->getExtension('CMS')->componentFunction("ProductInfo"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        echo "</h4>
    <h6 class=\"text-center\">";
        // line 5
        $context['__cms_component_params'] = [];
        $context['__cms_component_params']['showPrice'] = 1        ;
        echo $this->env->getExtension('CMS')->componentFunction("ProductInfo2"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        echo "</h6>
    <hr/>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-md-5\">
                ";
        // line 10
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("ProductDetails"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 11
        echo "            </div>
            <div class=\"col-md-4\">
                <div class=\"visible-xs\"><hr/></div>
                ";
        // line 14
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("ProductHistory"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 15
        echo "            </div>
            <div class=\"col-md-3\">
                <div class=\"visible-xs\"><hr/></div>
                ";
        // line 18
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("ProductAttribtues"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 19
        echo "            </div>
        </div>
    </div>
</div>
<br/>";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/pages/history.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 19,  63 => 18,  58 => 15,  54 => 14,  49 => 11,  45 => 10,  34 => 5,  27 => 4,  23 => 2,  19 => 1,);
    }
}
/* {% component 'breadcrumbs' %}*/
/* */
/* <div class="container">*/
/*     <h4>History for {% component 'ProductInfo' showTitle=1 %}</h4>*/
/*     <h6 class="text-center">{% component 'ProductInfo2' showPrice=1 %}</h6>*/
/*     <hr/>*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-md-5">*/
/*                 {% component 'ProductDetails' %}*/
/*             </div>*/
/*             <div class="col-md-4">*/
/*                 <div class="visible-xs"><hr/></div>*/
/*                 {% component 'ProductHistory' %}*/
/*             </div>*/
/*             <div class="col-md-3">*/
/*                 <div class="visible-xs"><hr/></div>*/
/*                 {% component 'ProductAttribtues' %}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <br/>*/

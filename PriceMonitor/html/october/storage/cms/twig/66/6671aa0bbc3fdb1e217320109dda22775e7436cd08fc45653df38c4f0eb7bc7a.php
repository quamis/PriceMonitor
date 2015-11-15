<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productadd/default.htm */
class __TwigTemplate_bcfcc35080cb06aca9d3181a7ed45df6cf781779c3627f228200f345df03f30a extends Twig_Template
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
        echo "<form 
\tdata-request=\"";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["__SELF__"]) ? $context["__SELF__"] : null), "html", null, true);
        echo "::onAddItem\"
\tdata-request-success=\"\$('#";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["__SELF__"]) ? $context["__SELF__"] : null), "html", null, true);
        echo "_url').val('')\"
>
\t<div class=\"panel panel-default\">
\t\t<div class=\"panel-heading\">URL to monitor</div>
\t</div>
\t<div class=\"panel-body\">
\t\t<div class=\"input-group\">
\t\t\t<input name=\"url\" type=\"text\" id=\"";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["__SELF__"]) ? $context["__SELF__"] : null), "html", null, true);
        echo "_url\" class=\"form-control\" value=\"\" />

\t\t\t<span class=\"input-group-btn\">
\t\t\t\t<button type=\"submit\" class=\"btn btn-primary\">Add</button>
\t\t\t</span>
\t\t</div>
\t</div>
</form>";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productadd/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 10,  26 => 3,  22 => 2,  19 => 1,);
    }
}
/* <form */
/* 	data-request="{{ __SELF__ }}::onAddItem"*/
/* 	data-request-success="$('#{{ __SELF__ }}_url').val('')"*/
/* >*/
/* 	<div class="panel panel-default">*/
/* 		<div class="panel-heading">URL to monitor</div>*/
/* 	</div>*/
/* 	<div class="panel-body">*/
/* 		<div class="input-group">*/
/* 			<input name="url" type="text" id="{{ __SELF__ }}_url" class="form-control" value="" />*/
/* */
/* 			<span class="input-group-btn">*/
/* 				<button type="submit" class="btn btn-primary">Add</button>*/
/* 			</span>*/
/* 		</div>*/
/* 	</div>*/
/* </form>*/

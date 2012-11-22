<?php

/* /alumno/buscar.php */
class __TwigTemplate_d40431bb03a01b40336a28ab6c830e3c extends Twig_Template
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
        echo "<div id=\"contenido\">
    <form id=\"form\" action=\"<?php echo base_url().'alumnos/buscar'; ?>\" method=\"post\">
    <div id=\"insert_form\">
        <div class=\"titulo\">
            Busqueda de Alumnos
        </div>
        <div class=\"row border_top border_bottom\" style=\"vertical-align: bottom\">
            <div class=\"input\">
                <label for=\"apellidos\">Apellidos</label>
                <input type=\"text\" name=\"apellidos\" id=\"apellidos\" />
            </div>
            <div class=\"input\">
                <label for=\"nombres\">Nombres</label>
                <input type=\"text\" name=\"nombres\" id=\"nombres\" />
            </div>
            <div class=\"input\">
                <label for=\"cd_identificacion\">Tipo Identificación:</label>
                <select id=\"cd_identificacion\" name=\"cd_identificacion\" class=\"required\">
                    ";
        // line 19
        if (isset($context["identificacion"])) { $_identificacion_ = $context["identificacion"]; } else { $_identificacion_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_identificacion_);
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 20
            echo "                    <option value=\"";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_i_, "id"), "html", null, true);
            echo "\">";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_i_, "ds_identificacion"), "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 22
        echo "                </select>
            </div>
            <div class=\"input\">
                <label for=\"ds_identificacion\">Número:</label>
                <input type=\"text\" id=\"numero_identificacion\" name=\"numero_identificacion\" class=\"required\"/>
            </div>    
            <div class=\"input\" style=\"padding-top: 20px\">
                <input type=\"hidden\" value=\"si\" name=\"busqueda\"/>
                <button onclick=\"form.submit()\">Buscar</button>
            </div>
        </div>
    </div>
    </form>
    <?php if(isset(\$alumnos)){ ?>
    <div class=\"row\"style=\"width: 90%; margin: auto\" >
    <table>
        <tr class=\"table_header\">
            <td>Apellidos</td><td>Nombres</td><td>Identificación</td><td>Fecha de Nacimiento</td><td>Nacionalidad</td><tD></td>
        </tr>
        
        ";
        // line 42
        $context["class"] = "table_row2";
        // line 43
        echo "        
        ";
        // line 44
        if (isset($context["alumnos"])) { $_alumnos_ = $context["alumnos"]; } else { $_alumnos_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_alumnos_);
        foreach ($context['_seq'] as $context["_key"] => $context["a"]) {
            // line 45
            echo "            ";
            if (isset($context["class"])) { $_class_ = $context["class"]; } else { $_class_ = null; }
            if (($_class_ == "table_row2")) {
                // line 46
                echo "                ";
                $context["class"] = "table_row1";
                // line 47
                echo "            ";
            } else {
                // line 48
                echo "                    ";
                $context["class"] = "table_row2";
                // line 49
                echo "            ";
            }
            // line 50
            echo "            
        <tr class=\"";
            // line 51
            if (isset($context["class"])) { $_class_ = $context["class"]; } else { $_class_ = null; }
            echo twig_escape_filter($this->env, $_class_, "html", null, true);
            echo "\">
            <td>";
            // line 52
            if (isset($context["a"])) { $_a_ = $context["a"]; } else { $_a_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_a_, "persona_id"), "nombres"), "html", null, true);
            echo "</td>
            <td>";
            // line 53
            if (isset($context["a"])) { $_a_ = $context["a"]; } else { $_a_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_a_, "persona"), "nombres"), "html", null, true);
            echo "</td>
            ";
            // line 54
            if (isset($context["a"])) { $_a_ = $context["a"]; } else { $_a_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($_a_, "persona"), "persona_identificacion"));
            foreach ($context['_seq'] as $context["_key"] => $context["identificacion"]) {
                // line 55
                echo "                ";
                if (isset($context["identificacion"])) { $_identificacion_ = $context["identificacion"]; } else { $_identificacion_ = null; }
                if ($this->getAttribute($_identificacion_, "principal")) {
                    // line 56
                    echo "            ?>                   
            <td> ";
                    // line 57
                    if (isset($context["identificacion"])) { $_identificacion_ = $context["identificacion"]; } else { $_identificacion_ = null; }
                    echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($_identificacion_, "widentificacion"), "ds_identificacion") . " ") . $this->getAttribute($_identificacion_, "numero_identificacion")), "html", null, true);
                    echo "</td>
                ";
                }
                // line 59
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['identificacion'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 60
            echo "            <td> ";
            if (isset($context["a"])) { $_a_ = $context["a"]; } else { $_a_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_a_, "persona"), "dt_nac"), "html", null, true);
            echo "</td>
            <td> ";
            // line 61
            if (isset($context["a"])) { $_a_ = $context["a"]; } else { $_a_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_a_, "persona"), "country"), "ds_pais"), "html", null, true);
            echo "</td>
            <td><a href=\"<?php echo base_url().'alumnos/alumno_data/'.\$a->persona->id; ?>\">Ver mas</a></td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['a'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 65
        echo "    </table>
    </div>
    <?php }?> 
        
</div>";
    }

    public function getTemplateName()
    {
        return "/alumno/buscar.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 65,  153 => 61,  147 => 60,  141 => 59,  135 => 57,  132 => 56,  128 => 55,  123 => 54,  118 => 53,  113 => 52,  108 => 51,  105 => 50,  102 => 49,  99 => 48,  96 => 47,  93 => 46,  89 => 45,  84 => 44,  81 => 43,  79 => 42,  57 => 22,  44 => 20,  39 => 19,  19 => 1,);
    }
}

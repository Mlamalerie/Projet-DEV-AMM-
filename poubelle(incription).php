  <!--DATE DE NAISSANCE-->
                                        <div id="divNaissance" class="form-group btn-group dropup">
                                            <?php

                                            if(isset($err_naiss_jour)){
                                                echo $err_naiss_jour;
                                            } 
                                            if(isset($err_naiss_mois)){
                                                echo $err_naiss_mois;
                                            }
                                            if(isset($err_naiss_annes)){
                                                echo $err_naiss_annes;
                                            }
                                            if(isset($err_date)){
                                                echo $err_date;
                                            }
                                            ?>
                                            <select name="naiss_jour" class="form-control rounded-pill custom-select ">
                                                <?php

                                                listannee(1,31);
                                                ?>
                                            </select>
                                            <select name="naiss_mois" class="form-control rounded-pill border-0 shadow-sm px-4 dropdown-toggle">
                                                <option value="1">Janvier </option>
                                                <option value="2">Février </option>
                                                <option value="3">Mars </option>
                                                <option value="4">Avril </option>
                                                <option value="5">Mai</option>
                                                <option value="6">Juin </option>
                                                <option value="7">Juillet </option>
                                                <option value="8">Aout </option>
                                                <option value="9">Septembre </option>
                                                <option value="10">Octobre </option>
                                                <option value="11">Novembre </option>
                                                <option value="12">Décembre </option>
                                            </select>
                                            <select name="naiss_annees" class="form-control rounded-pill border-0 shadow-sm px-4 dropdown-toggle">
                                                <?php
                                                listannee(1950,70);
                                                ?>
                                            </select> 
                                        </div>
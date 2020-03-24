<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('seniorcarealertbt');
sendVarToJS('eqType', $plugin->getId());
$eqLogics = eqLogic::byType($plugin->getId());
?>

<div class="row row-overflow">

  <div class="col-xs-12 eqLogicThumbnailDisplay">
    <legend><i class="fas fa-cog"></i>  {{Gestion}}</legend>
    <div class="eqLogicThumbnailContainer">
        <div class="cursor eqLogicAction logoPrimary" data-action="add">
          <i class="fas fa-plus-circle"></i>
          <br>
          <span>{{Ajouter}}</span>
      </div>
        <div class="cursor eqLogicAction logoSecondary" data-action="gotoPluginConf">
        <i class="fas fa-wrench"></i>
      <br>
      <span>{{Configuration}}</span>
    </div>
    </div>
    <legend><i class="fas fa-table"></i> {{Personne dépendante}}</legend>
  	   <input class="form-control" placeholder="{{Rechercher}}" id="in_searchEqlogic" />
  <div class="eqLogicThumbnailContainer">
      <?php
  foreach ($eqLogics as $eqLogic) {
  	$opacity = ($eqLogic->getIsEnable()) ? '' : 'disableCard';
  	echo '<div class="eqLogicDisplayCard cursor '.$opacity.'" data-eqLogic_id="' . $eqLogic->getId() . '">';
  	echo '<img src="' . $plugin->getPathImgIcon() . '"/>';
  	echo '<br>';
  	echo '<span class="name">' . $eqLogic->getHumanName(true, true) . '</span>';
  	echo '</div>';
  }
  ?>
  </div>
  </div>

<div class="col-xs-12 eqLogic" style="display: none;">
		<div class="input-group pull-right" style="display:inline-flex">
			<span class="input-group-btn">
				<a class="btn btn-default btn-sm eqLogicAction roundedLeft" data-action="configure"><i class="fa fa-cogs"></i> {{Configuration avancée}}</a><a class="btn btn-default btn-sm eqLogicAction" data-action="copy"><i class="fas fa-copy"></i> {{Dupliquer}}</a><a class="btn btn-sm btn-success eqLogicAction" data-action="save"><i class="fas fa-check-circle"></i> {{Sauvegarder}}</a><a class="btn btn-danger btn-sm eqLogicAction roundedRight" data-action="remove"><i class="fas fa-minus-circle"></i> {{Supprimer}}</a>
			</span>
		</div>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay"><i class="fa fa-arrow-circle-left"></i></a></li>
    <li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-tachometer-alt"></i> {{Général}}</a></li>

<!--     <li role="presentation"><a href="#absencestab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-calendar-alt"></i> {{Gestion absences}}</a></li>

    <li role="presentation"><a href="#lifesigntab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-heartbeat"></i> {{Détection d'inactivité}}</a></li> -->

    <li role="presentation"><a href="#alertbttab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-toggle-on"></i> {{Bouton d'alerte}}</a></li>

<!--     <li role="presentation"><a href="#conforttab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-spa"></i> {{Confort}}</a></li>

    <li role="presentation"><a href="#securitytab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-exclamation-triangle"></i> {{Sécurité}}</a></li>

    <li role="presentation"><a href="#alertesPerteAutonomietab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-brain"></i> {{Dérive comportementale}}</a></li> -->

    <li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> {{Avancé - Commandes Jeedom}}</a></li>

  </ul>

  <div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">

    <!-- TAB GENERAL -->
    <div role="tabpanel" class="tab-pane active" id="eqlogictab">
      <br/>
      <form class="form-horizontal">
        <fieldset>
          <div class="form-group">
            <label class="col-sm-3 control-label">{{Nom de la personne dépendante}}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
              <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de la personne dépendante}}"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" >{{Objet parent}}</label>
            <div class="col-sm-3">
              <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                <option value="">{{Aucun}}</option>
                <?php
                  foreach (jeeObject::all() as $object) {
  	                echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
                  }
                ?>
              </select>
            </div>
          </div>
  	   <!--div class="form-group">
                  <label class="col-sm-3 control-label">{{Catégorie}}</label>
                  <div class="col-sm-9">
                   <?php
                    //  foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
                    //  echo '<label class="checkbox-inline">';
                    //  echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
                    //  echo '</label>';
                    //  }
                    ?>
                 </div>
             </div-->
        	<div class="form-group">
        		<label class="col-sm-3 control-label"></label>
        		<div class="col-sm-9">
        			<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
        			<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
        		</div>
        	</div>
        </fieldset>
      </form>
    </div>

    <!-- TAB Capteurs Bouton alerte immédiate -->
    <div class="tab-pane" id="alertbttab">
      <br/>
      <div class="alert alert-info">
        {{Onglet de configuration de boutons d'alerte immédiate pour prévenir les aidants.}}
      </div>

        <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-toggle-on"></i> {{Boutons d'alerte immédiate (quel actionneur va lancer une alerte ?)}}
            <a class="btn btn-success btn-sm addSensorBtAlert" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter un bouton}}</a>
          </legend>
          <div id="div_alert_bt"></div>
        </fieldset>
      </form>

      <br>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-bomb"></i> {{Actions alerte immédiate vers les aidants (pour alerter, je dois ?)}} <sup><i class="fas fa-question-circle tooltips" title="{{Actions réalisées à l'activation d'un bouton d'alerte par la personne dépendante.
          Tag utilisable : #senior_name#.}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_alert_bt" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>
          <div id="div_action_alert_bt"></div>

        </fieldset>
      </form>

      <br>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-toggle-off"></i> {{Boutons d'annulation d'alerte (quel actionneur pour couper l'alerte ?)}} <sup><i class="fas fa-question-circle tooltips" title="{{Bouton de désactivation d'alerte}}"></i></sup>
            <a class="btn btn-success btn-sm addSensorCancelBtAlert" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter un bouton}}</a>
          </legend>
          <div id="div_cancel_alert_bt"></div>
        </fieldset>
      </form>

      <br>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-hand-paper"></i> {{Actions pour arrêter l'alerte vers les aidants (pour annuler l'alerte, je dois ?)}} <sup><i class="fas fa-question-circle tooltips" title="{{Actions réalisées sur activation d'un bouton d'annulation d'alerte.
          Tag utilisable : #senior_name#.}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_cancel_alert_bt" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>
          <div id="div_action_cancel_alert_bt"></div>

        </fieldset>
      </form>

    </div>

    <!-- TAB COMMANDES -->
    <div role="tabpanel" class="tab-pane" id="commandtab">
      <a class="btn btn-success btn-sm cmdAction pull-right" data-action="add" style="margin-top:5px;"><i class="fa fa-plus-circle"></i> {{Commandes}}</a><br/><br/>
      <table id="table_cmd" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>{{Nom}}</th><th>{{Type}}</th><th>{{Action}}</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>





  </div> <!-- fin DIV contenant toutes les tab -->

</div>
</div>

<?php include_file('desktop', 'seniorcarealertbt', 'js', 'seniorcarealertbt');?>
<?php include_file('core', 'plugin.template', 'js');?>
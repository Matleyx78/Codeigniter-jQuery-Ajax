<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$this->load->view('templates/header');

//$arr = get_defined_vars();
//echo '<pre>';
//print_r($_ci_vars);
//echo '</pre>';

?>
	<script type="text/javascript">
	$(document).ready(function(){

		var scegli = '<option value="0">Scegli...</option>';
		var attendere = '<option value="0">Attendere...</option>';
		
		$("select#province").html(scegli);
		$("select#province").attr("disabled", "disabled");
		$("select#comuni").html(scegli);
		$("select#comuni").attr("disabled", "disabled");
		
		
		$("select#regioni").change(function(){
			var regione = $("select#regioni option:selected").attr('value');
			$("select#province").html(attendere);
			$("select#province").attr("disabled", "disabled");
			$("select#comuni").html(scegli);
			$("select#comuni").attr("disabled", "disabled");
			
			$.post("<?php echo site_url('/ajax/selectprov'); ?>", {id_regione:regione}, function(data){
				$("select#province").removeAttr("disabled"); 
				$("select#province").html(data);	
			});
		});	
		
		$("select#province").change(function(){
			$("select#comuni").attr("disabled", "disabled");
			$("select#comuni").html(attendere);
			var provincia = $("select#province option:selected").attr('value');
			$.post("<?php echo site_url('/ajax/selectcom'); ?>", {id_provincia:provincia}, function(data){
				$("select#comuni").removeAttr("disabled");
				$("select#comuni").html(data);	
			});
		});	
	});
	
	</script>
<div id="container">
	<?php echo form_open('ajax/informazioni'); ?>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="regioni" class="control-label">Regione</label>
                        <div class="form-group">
                            <select name="regioni" id="regioni" class="form-group">
                                
                                <?php echo $regioni; ?>
                            </select>
                        </div>
                </div>                            
            </div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="province" class="control-label">Province</label>
                        <div class="form-group">
                            <select name="province" id="province" class="form-group">
                                <option>Scegli...</option>
                            </select>
                        </div>
                </div>                            
            </div>    
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label for="comuni" class="control-label">Regione</label>
                        <div class="form-group">
                            <select name="comuni" id="comuni" class="form-group">
                                <option>Scegli...</option>
                            </select>
                        </div>
                </div>                            
            </div>    
    
						<div class="form-group">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-check"></i> Salva
							</button>
						</div>
			
		
<?php echo form_close(); ?>
        </div>
<?php $this->load->view('templates/footer');?>
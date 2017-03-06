<?php $csrf = array('name' => $this->security->get_csrf_token_name(),'hash' => $this->security->get_csrf_hash());?>
<div class="header">
  <span class="titulo_pagina"><?php echo $this->config->item('producto');?></span>
</div>

<div class="content">
  <div class="sub_content">
    <div class="pure-g">
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>orden/venta_mayor" class="button-secondary pure-button" style="width:100%;">Venta mayor</a></p></div>
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>orden/venta_menor" class="button-secondary pure-button" style="width:100%;">Venta menor</a></p></div>
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>orden/venta_especial" class="button-secondary pure-button" style="width:100%;">Venta especial</a></p></div>
    </div>
    <div class="pure-g">
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>orden/anular_orden" class="button-secondary pure-button" style="width:100%;">Reimprimir/Anular</a></p></div>
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>movimiento/egreso" class="button-secondary pure-button" style="width:100%;">Generar egreso</a></p></div>
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>cliente/" class="button-secondary pure-button" style="width:100%;">Administrar clientes</a></p></div>
    </div>
    <div class="pure-g">
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>admin/tasa" class="button-secondary pure-button" style="width:100%;">Reportes</a></p></div>
      <div class="pure-u-1 pure-u-md-1-3"><p style="margin:5px 20px 5px 20px"><a href="<?php echo base_url();?>admin/plazo" class="button-secondary pure-button" style="width:100%;">Cambiar contraseña</a></p></div>
    </div>
  </div>
</div>

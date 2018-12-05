<?php
$hideClear = isset($hideClear) ? 'hide' : '';
?>
<div class="js-fixed-actions">
	<button class="btn btn-light {{ $hideClear }}" type="reset">Limpar</button>
	<button class="btn btn-primary pull-right js-submit" type="submit">Salvar</button>
</div>
<div class="gc_marketplace__combination-tags gc_marketplace__combination-sizes">
    <div class="gc_marketplace__combination-title">
        <span class="title">Tallas</span>
    </div>
    <div class="gc_marketplace__scrollcontainer">
        <div class="split left">
            <?php
                for ($i = 0; $i < 10; $i++){
                    if($i != 9){
                        echo '<div class="gc_marketplace__combination-attribute">
                                    <label class="gc_marketplace__combination-label">
                                        <input type="checkbox" value="Celeste intermedio" name="check-combination" class="checksito">
                                        <span class="gc_marketplace__combination-text">Celeste intermedio</span>
                                    </label>
                                
                            </div>';
                    }else {
                        echo '<div class="gc_marketplace__combination-attribute">
                                    <label class="gc_marketplace__combination-label">
                                        <input type="checkbox" value="cambio de planes" id="celeste_intermedio" class="checksito" name="check-combination">
                                        <span class="gc_marketplace__combination-text">Celeste intermedio</span>
                                    </label>
                            </div>';
                    }

                }
            ?>

        </div>
        <div class="split right">
            <?php
            for ($i = 0; $i < 10; $i++){
            echo '<div class="gc_marketplace__combination-attribute">
                    <label class="gc_marketplace__combination-label">
                        <input type="checkbox" value="este no es celeste" class="checksito" name="check-combination">
                        <span class="gc_marketplace__combination-text">Celeste intermedio</span>
                    </label>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>
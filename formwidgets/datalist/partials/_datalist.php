<?php if ($this->previewMode): ?>

    <div class="form-control">
        <?= $value ?>
    </div>

<?php else: ?>
    <div class="datalist-container" data-control="datalist" data-max-items="<?= $maxItems?>">
        
        <div class="input-wrapper">
            <input type="text"
                name="<?= $field->getName() ?>"
                id="<?= $field->getId() ?>"
                value="<?= e($field->value) ?>"
                placeholder="<?= e(($field->placeholder)) ?>"
                class="form-control"
                autocomplete="off" 
                <?= $field->getAttributes() ?>/>
            
            <i class="icon-close clear-input"></i>

        </div>

        <div class="datalist-results"></div>

        <ul class="optionsList <?= ($useGroups) ? 'groupsList' : null; ?>">
            
            <?php if($useGroups): ?>
                
                <?php foreach ($options as $groupKey => $group): ?>
                    
                    <?php  if($useGroupKey): ?>

                        <li class="option opt-group" data-value="<?= $groupKey; ?>"><?= $group['name']; ?></li>
                
                        <?php foreach ($group['items'] as $key => $value): ?>
                            <li class="option" data-value="<?= ($useOptionKey) ? $key : $value; ?>"><?= $value; ?></li>
                        <?php endforeach ?>
                    
                    <?php else: ?>

                        <?php 
                            $groupName = !isset($group['name']) ? $groupKey : $group['name']; 
                            $items = !isset($group['items']) ? $group : $group['items']; 
                        ?>

                        <li class="option opt-group" data-value="<?= $groupName; ?>"><?= $groupName; ?></li>
                
                        <?php foreach ($items as $key => $value): ?>
                            <li class="option" data-value="<?= ($useOptionKey) ? $key : $value; ?>"><?= $value; ?></li>
                        <?php endforeach ?>
                    <?php endif; ?>

                <?php endforeach ?>
            
            <?php else: ?>

                <?php foreach ($options as $key => $value): ?>
                    <li class="option" data-value="<?= ($useOptionKey) ? $key : $value; ?>"><?= $value; ?></li>
                <?php endforeach ?>
            <?php endif; ?>
            
        </ul>
    </div>

   


<?php endif ?>

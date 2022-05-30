<div class=" p-4 flex-none sm:w-144">
    <div class=" bg-fuchsia-50 border-2 border-fuchsia-700 rounded">
        <div class="flex">
            <div class="w-1/2">
                <h2 class=" p-2 text-3xl text-fuchsia-800"><?=$monster['name']?></h2>
                <p class="italic px-2 text-gray-400"><?=$monster['size']?> <?=$monster['type']?></p>
                <p class=" pl-2 pt-8">Armor Class: <?=$monster['armor_class']?></p>
                <p class=" p-2">Hit Points: <?=$monster['hit_points']?></p>
            </div>
            <div class="w-1/2 h-64 p-2 flex items-center justify-center">
                <?php if ($monster['image']) { ?>
                <img src="<?=$monster['image']?>" alt="<?=$monster['name']?> image" class=" max-h-full max-w-full rounded-lg overflow-hidden">
                <?php } ?>
            </div>
        </div>
        <div class="flex text-center py-2 border-t-2 border-fuchsia-200">
            <div class="w-1/6">
                <p>STR</p>
                <p><?=$monster['strength']?> (<?php echo modifier($monster['strength']) ?>)</p>
            </div>
            <div class="w-1/6">
                <p>DEX</p>
                <p><?=$monster['dexterity']?> (<?php echo modifier($monster['dexterity']) ?>)</p>
            </div>
            <div class="w-1/6">
                <p>CON</p>
                <p><?=$monster['constitution']?> (<?php echo modifier($monster['constitution']) ?>)</p>
            </div>
            <div class="w-1/6">
                <p>INT</p>
                <p><?=$monster['intelligence']?> (<?php echo modifier($monster['intelligence']) ?>)</p>
            </div>
            <div class="w-1/6">
                <p>WIS</p>
                <p><?=$monster['wisdom']?> (<?php echo modifier($monster['wisdom']) ?>)</p>
            </div>
            <div class="w-1/6">
                <p>CHA</p>
                <p><?=$monster['charisma']?> (<?php echo modifier($monster['charisma']) ?>)</p>
            </div>
        </div>
    </div>
</div>

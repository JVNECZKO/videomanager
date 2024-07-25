{block name='form'}
<form action="{current}" method="post">
    <fieldset>
        <legend>{$legend}</legend>
        <label>{$title_label}</label>
        <div class="margin-form">
            <input type="text" name="title" value="{$video.title}" required="required">
        </div>
        <label>{$description_label}</label>
        <div class="margin-form">
            <textarea name="description">{$video.description}</textarea>
        </div>
        <label>{$url_label}</label>
        <div class="margin-form">
            <input type="text" name="url" value="{$video.url}" required="required">
        </div>
        <label>{$watch_time_label}</label>
        <div class="margin-form">
            <input type="text" name="watch_time" value="{$video.watch_time}">
        </div>
        <label>{$brand_label}</label>
        <div class="margin-form">
            <select name="brand_id">
                {foreach $brands as $brand}
                <option value="{$brand.id_brand}" {if $brand.id_brand == $video.brand_id}selected{/if}>{$brand.name}</option>
                {/foreach}
            </select>
        </div>
        <div class="margin-form">
            <button type="submit" class="btn btn-default">{$save}</button>
        </div>
    </fieldset>
</form>
{/block}

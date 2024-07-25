<form method="GET" action="">
    <input type="text" name="search_query" placeholder="Search videos..." value="{Tools::getValue('search_query')}">
    <button type="submit">Search</button>
</form>

{block name='grid_panel'}
<div class="panel">
    {foreach $videos as $video}
    <div class="video-item">
        <h3>{$video.title}</h3>
        <p>{$video.description}</p>
        <a href="{$video.url}" target="_blank">Watch Video</a>
        <p>Brand: {$video.brand}</p>
        <p>Watch Time: {$video.watch_time} seconds</p>
    </div>
    {/foreach}
</div>
{/block}

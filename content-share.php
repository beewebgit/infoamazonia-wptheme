<?php get_header(); ?>

<section id="content"><div class="gray-page">
  <div id='ia-widget' class='limiter'>
    <div id='configuration' class='clearfix'>
      <div class='section layer'>
        <div class='inner'>
          <?php if(!isset($_GET['map_id'])) : ?>
            <h4>
              <?php _e('Choose a map', 'infoamazonia'); ?>
              <a class='tip' href='#'>
                ?
                <div class='popup arrow-left'>
                  Choose any map from the list.
                </div>
              </a>
            </h4>
            <div id='maps'>
              <?php $maps = get_posts(array('post_type' => 'map', 'posts_per_page' => -1)); ?>
              <select id="map-select" data-placeholder="<?php _e('Select a map', 'infoamazonia'); ?>" class="chzn-select">
                <?php foreach($maps as $map) : ?>
                  <option value="<?php echo $map->ID; ?>"><?php echo get_the_title($map->ID); ?></option>
                <?php endforeach; ?>
              </select>
              <a href="#" class="select-map-layers" style="display:block;margin-top:5px;"><?php _e('Select layers from this map', 'infoamazonia'); ?></a>
            </div>
          <?php else : ?>
            <?php 
            $map_id = $_GET['map_id'];
            $map = get_post($map_id);
            if($map) : ?>
              <h4>
                <?php echo __('Select layers from ', 'infoamazonia') . get_the_title($map_id); ?>
                <a class='tip' href='#'>
                  ?
                  <div class='popup arrow-left'>
                    Choose layers from the list.
                  </div>
                </a>
              </h4>
              <div id='maps'>
                <?php
                $layers = mappress_get_map_layers($map_id);
                if($layers) : ?>
                  <select id="layers-select" data-placeholder="<?php _e('Select layers', 'infoamazonia'); ?>" data-mapid="<?php echo $map_id; ?>" class="chzn-select" multiple>
                    <?php foreach($layers as $layer) : ?>
                      <option value="<?php echo $layer['id']; ?>" selected><?php if($layer['title']) : echo $layer['title']; else : echo $layer['id']; endif; ?></option>
                    <?php endforeach; ?>
                  </select>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>

      <div class='section'>
        <div class='inner'>
          <h4>
            Select a Story
            <a class='tip' href='#'>
              ?
              <div class='popup arrow-left'>
                Choose a story from a variety of
                different sources.
              </div>
            </a>
          </h4>
          <?php $publishers = get_terms('publisher'); ?>
          <div id='stories'>
          	<select id="stories-select" data-placeholder="<?php _e('Select stories', 'infoamazonia'); ?>" class="chzn-select">
              <?php
              if(isset($_GET['p'])) :
                $story = get_post($_GET['p']);
                if($story) : ?>
                  <optgroup label="<?php _e('Selected story', 'infoamazonia'); ?>">
                    <option value="story&<?php echo $story->ID; ?>" selected><?php echo get_the_title($story->ID); ?></option>
                  </optgroup>
                <?php endif; ?>
              <?php endif; ?>
              <optgroup label="<?php _e('General stories', 'infoamazonia'); ?>">
        				<option value="latest"><?php if(!isset($_GET['map_id'])) _e('Stories from the map', 'infoamazonia'); else _e('Latest stories', 'infoamazonia'); ?></option>
        				<option value="no-story"><?php _e('No stories', 'infoamazonia'); ?></option>
              </optgroup>
      				<optgroup label="<?php _e('By publishers', 'infoamazonia'); ?>">
      					<?php foreach($publishers as $publisher) : ?>
      						<option value="publisher&<?php echo $publisher->slug; ?>"><?php echo $publisher->name; ?></option>
      					<?php endforeach; ?>
      				</optgroup>
          	</select>
          </div>
        </div>
      </div>

      <div class='section size'>
        <div class='inner'>
          <h4>
            Width &amp; Height
            <a class='tip' href='#'>
              ?
              <div class='popup arrow-left'>
                Select the width and height
                proportions you would like the
                embed to be.
              </div>
            </a>
          </h4>
          <ul id='sizes' class='sizes clearfix'>
            <li><a href='#' data-size='small' data-width='480' data-height='300'>Small</a></li>
            <li><a href='#' data-size='medium' data-width='600' data-height='400'>Medium</a></li>
            <li><a href='#' data-size='large' data-width='960' data-height='480' class='active'>Large</a></li>
          </ul>
        </div>
      </div>

      <div class='section output'>
        <div class='inner'>
          <h4>
            <div class='popup arrow-right'>
            </div>
            HTML Output
            <a class='tip' href='#'>
              ?
              <div class='popup arrow-left'>
                Copy and paste this code into
                an HTML page.
              </div>
            </a>
          </h4>
          <textarea id='output'></textarea>
        </div>
      </div>
    </div>

    <div class='content' id='widget-content'>
    	<!-- iframe goes here -->
    </div>

  </div>
</div></div>

<script type="text/javascript">
	jQuery(document).ready(function($) { 
		widget.controls();
	});
</script>

<?php get_footer(); ?>
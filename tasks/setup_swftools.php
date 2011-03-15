<?php

function _profile_setup_swftools() {

    /**
     * Embed Settings
     * admin/settings/swftools/embed
     */

    // Embed Method
    //   swfobject2_replace: SWFObject 2
    //   swftools_nojavascript: Direct embedding
    variable_set('swftools_embed_method', 'swfobject2_replace');


    /**
     * File Handling
     * admin/settings/swftools/handling
     */

    // Default player for single FLV movies:
    //   flowplayer3_mediaplayer
    //   generic_flv
    variable_set('swftools_flv_display', 'flowplayer3_mediaplayer');

    // Default player for single MP3 files:
    //   flowplayer3_mediaplayer
    //   generic_mp3
    variable_set('swftools_mp3_display', 'flowplayer3_mediaplayer');

    // Default player for a list of FLV movies:
    variable_set('swftools_flv_display_list', 'flowplayer3_mediaplayer');

    // Default player for a list of MP3 music files:
    variable_set('swftools_mp3_display_list', 'flowplayer3_mediaplayer');

    // Default player for a list of mixed media:
    variable_set('swftools_media_display_list', 'flowplayer3_mediaplayer');


    /**
     * FlowPlayer3 Settings
     * admin/settings/swftools/flowplayer3
     */

    // Color Scheme
    variable_set('flowplayer3_palette', array(
        'backgroundColor' => '#ede6d6',
        'controlbarbackgroundColor' => '#ede6d6',
        'timeColor' => '#3f778f',
        'durationColor' => '#3f778f',
        'progressColor' => '#3f778f',
        'bufferColor' => '#82A4B4',
        'sliderColor' => '#3f778f',
        'buttonColor' => '#3f778f',
        'buttonOverColor' => '#82A4B4',
    ));

    // Player file:
    //   Place in /swftools/shared/flowplayer3/
    variable_set('flowplayer3_mediaplayer_file', "flowplayer-3.2.4.swf");

    // Clip, Control Bar & Canvas properties
    variable_set('flowplayer3_mediaplayer', array(
        'clip' => array(
            'autoPlay' => 'false',
            'autoBuffering' => 'false',
            'scaling' => 'scale',
            'start' => '',
            'duration' => '',
            'accelerated' => 'false',
            'bufferLength' => '',
            'provider' => '',
            'fadeInSpeed' => '',
            'fadeOutSpeed' => '',
            'linkUrl' => '',
            'linkWindow' => '_blank',
            'live' => 'false',
            'cuePointMultiplier' => '',
        ),
        'controls' => array(
            'backgroundGradient' => 'none',
            'progressGradient' => 'none',
            'bufferGradient' => 'none',
            'sliderGradient' => 'none',
            'autoHide' => 'fullscreen',
            'play' => 'true',
            'volume' => 'true',
            'mute' => 'true',
            'time' => 'true',
            'stop' => 'false',
            'playlist' => 'false',
            'fullscreen' => 'true',
            'scrubber' => 'true',
        ),
        'canvas' => array(
            'height' => '311',
            'width' => '522',
            'backgroundImage' => '',
            'backgroundRepeat' => 'repeat',
            'backgroundGradient' => 'low',
            'border' => '',
            'borderRadius' => '',
        ),
    ));
}

{OVERALL_GAME_HEADER}

<!-- 
--------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- GolemsMatchbox implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-------

    golemsmatchbox_golemsmatchbox.tpl
    
    This is the HTML template of your game.
    
    Everything you are writing in this file will be displayed in the HTML page of your game user interface,
    in the "main game zone" of the screen.
    
    You can use in this template:
    _ variables, with the format {MY_VARIABLE_ELEMENT}.
    _ HTML block, with the BEGIN/END format
    
    See your "view" PHP file to check how to set variables and control blocks
    
    Please REMOVE this comment before publishing your game on BGA
-->

<div id="opponent_table" class="whiteblock personal_area">
    <h3 id="opponent_name"></h3>
    <!--div class="card"></div-->
        <div id="opponent_red">
            <div id="opponent_Red_1"></div>
        </div>
        <div id="opponent_blue">
            <div id="opponent_Blue_1"></div>
        </div>
        <div id="opponent_green">
            <div id="opponent_Green_1"></div>
        </div>
        <div id="opponent_yellow">
            <div id="opponent_Yellow_1"></div>
        </div>
        <div id="opponent_time">
            <div id="opponent_Time_1"></div>
        </div>
        <div id="opponent_gemdust">
            <div id="opponent_Gemdust_1"></div>
        </div>
        <div id="opponent_golem">
            <div id="opponent_Golem_1"></div>
            <div id="opponent_Golemdiscard_1"></div>
        </div>
</div>
<div class="shared_area">

    <div id="topleft_1" class="topleft_1"></div>
    <div id="topleft_2" class="topleft_2"></div>
    <div id="topleft_3" class="topleft_3"></div>

    <div id="bottomleft_1" class="bottomleft_1"></div>
    <div id="bottomleft_2" class="bottomleft_2"></div>
    <div id="bottomleft_3" class="bottomleft_3"></div>

<div id="bank_gem_0"></div>
<div id="bank_gem_2"></div>
<div id="bank_gem_4"></div>
<div id="bank_gem_6"></div>
<div id="bank_gem_8"></div>
<div id="bank_gem_10"></div>
<div id="bank_gem_12"></div>
<div id="bank_gem_14"></div>
    <div id="golem_deck">
        <div class="facedown_card deck_shadow">
        </div>
    </div>

<div id="bank_gem_1"></div>
<div id="bank_gem_3"></div>
<div id="bank_gem_5"></div>
<div id="bank_gem_7"></div>
<div id="bank_gem_9"></div>
<div id="bank_gem_11"></div>
<div id="bank_gem_13"></div>
<div id="bank_gem_15"></div>

    <div id="topright_1"></div>
    <div id="topright_2"></div>
    <div id="topright_3"></div>

    <div id="bottomright_1"></div>
    <div id="bottomright_2"></div>
    <div id="bottomright_3"></div>

</div>

<div id="my_table" class="whiteblock personal_area">
    <h3="my_name"></h3>
    <div id="mytable">
        <!--div class="card"></div-->
        <div id="my_red">
            <div id="my_Red_1"></div>
        </div>
        <div id="my_blue">
            <div id="my_Blue_1"></div>
        </div>
        <div id="my_green">
            <div id="my_Green_1"></div>
        </div>
        <div id="my_yellow">
            <div id="my_Yellow_1"></div>
        </div>
        <div id="my_time">
            <div id="my_Time_1"></div>
        </div>
        <div id="my_gemdust">
            <div id="my_Gemdust_1"></div>
        </div>
        <div id="my_golem">
            <div id="my_Golem_1"></div>
            <div id="my_Golemdiscard_1"></div>
        </div>
    </div>
</div>

<div id="my_hand" class="whiteblock personal_hand">
    <h3>{MY_HAND}</h3>
    <div id="my_hand">
        <div id="my_hand_0"></div>
        <div id="my_hand_1"></div>
        <div id="my_hand_2"></div>
        <div id="my_hand_3"></div>
        <div id="my_hand_4"></div>
        <div id="my_hand_5"></div>
        <div id="my_hand_6"></div>
        
    </div>
</div>


<script type="text/javascript">

// Javascript HTML templates

var jstpl_faceupcard = '<div class="card card_shadow" id="faceupcard_${card_id}" style="background-position:-${x}px -${y}px">\
                        </div>';
var jstpl_facedowncard = '<div class="card_back card_shadow" id="card_${location}_${location_arg}" style="background-position:-${x}px -${y}px">\
                        </div>';
var jstpl_gem = '<div class="gem_${num}" id="gem_${id}">\
                        </div>';
var jstpl_player_board = '\<div id=playerinfo_p${id} class="playerinfo">\
    <span id="gemsicon_p${id}" class="gem_${num} gem_icon"></span><span id="gemcount_p${id}" class="gem_counter">${gems}</span>\
    <span id="handicon_p${id}" class="hand_icon"></span><span id="handcount_p${id}" class="hand_counter">${hand_count}</span>\
</div>';
/*
// Example:
var jstpl_some_game_item='<div class="my_game_item" id="my_game_item_${MY_ITEM_ID}"></div>';

*/

</script>  

{OVERALL_GAME_FOOTER}

<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * GolemsMatchbox implementation : © Stefano Nicotra 9stefanonicotra4@gmail.com
 * 
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * material.inc.php
 *
 * GolemsMatchbox game material description
 *
 * Here, you can describe the material of your game with PHP variables.
 *   
 * This file is loaded in your game logic class constructor, ie these variables
 * are available everywhere in your game logic code.
 *
 */


/*

Example:

$this->card_types = array(
    1 => array( "card_name" => ...,
                ...
              )
);

*/

$this->game_gems = 13;
$this->starting_gems = 4;

$this->card_types = array(
  1 => array(
    'name' => clienttranslate('Golem'),
    'nametr' => self::_('Golem'),
    'top' => clienttranslate("golem"),
    'bottom' => clienttranslate("resource") ),
  2 => array(
    'name' => clienttranslate('Gem'),
    'nametr' => self::_('Gem'),
    'top' => clienttranslate("gems"),
    'bottom' => clienttranslate("gemdust")),
  3 => array(
    'name' => clienttranslate('Rune'),
    'nametr' => self::_('Rune'), 
    'top' => clienttranslate("rune"),
    'bottom' => clienttranslate("resource") ),
);


$this->gem_card_types = array(
  1 => array(
    'gems' => 3,
    'points' => 0,
    'description' => self::_('Receive 3 Gems.' ) ),
  2 => array(
    'gems' => 2,
    'points' => 1,
    'description' => self::_('Receive 2 Gems immediately and 1 point at the end of the game.') ),
  3 => array(
    'gems' => 1,
    'points' => 2,
    'description' => self::_('Receive 1 Gem immediately and 2 points at the end of the game.') ),
  4 => array(
    'gems' => 1,
    'points' => 0,
    'description' => self::_('Receive 1 Gem immediately and take another turn.') ),
  5 => array(
    'gems' => 1,
    'points' => 0,
    'description' => self::_('Receive 1 Gem immediately.In this turn, you take 6 cards from the grid instead of 5.') ),
  6 => array(
    'gems' => 2,
    'points' => 0,
    'description' => self::_('Receive 2 Gems immediately. When summoning a Golem you can use this card as any resource, by discarding it from the game.') ),
  7 => array(
    'gems' => 1,
    'points' => 0,
    'description' => self::_('Receive 1 Gem immediately. Whenever you get both cards with this symbol you must take, in hand, the 2 cards discarded at the beginning of the game. Discard one and use the other at no cost.') ),
  8 => array(
    'gems' => 1,
    'points' => 0,
    'description' => self::_('Receive 1 Gem immediately. Whenever you get both cards with this symbol you must take, in hand, the 2 cards discarded at the beginning of the game. Discard one and use the other at no cost.') )
);

$this->rune_card_types = array (
  //Time
  1 => array (
    'points' => 2,
    'points_max' => 8,
    'name' => self::_('Master of the Elements'),
    'description' => self::_('Receive 2 points for each Summoned Golem of the corresponding type. You can receive a maximum of 8 points for the Time Golem.') ),
  //Blue
  2 => array (
    'points' => 2,
    'points_max' => 99,
    'name' => self::_('Master of the Elements'),
    'description' => self::_('Receive 2 points for each Summoned Golem of the corresponding type. You can receive a maximum of 8 points for the Time Golem.') ),
  //Green
  3 => array (
    'points' => 2,
    'points_max' => 99,
    'name' => self::_('Master of the Elements'),
    'description' => self::_('Receive 2 points for each Summoned Golem of the corresponding type. You can receive a maximum of 8 points for the Time Golem.') ),
  //Red
  4 => array (
    'points' => 2,
    'points_max' => 99,
    'name' => self::_('Master of the Elements'),
    'description' => self::_('Receive 2 points for each Summoned Golem of the corresponding type. You can receive a maximum of 8 points for the Time Golem.') ),
  //Yellow
  5 => array (
    'points' => 2,
    'points_max' => 99,
    'name' => self::_('Master of the Elements'),
    'description' => self::_('Receive 2 points for each Summoned Golem of the corresponding type. You can receive a maximum of 8 points for the Time Golem.') ),
  6 => array (
    'points' => 7,
    'points_max' => 7,
    'name' => self::_('Master Summoner'),
    'description' => self::_('Receive 7 points if you have Summoned Golems of at least 4 different types.') ),
  7 => array (
    'points' => 1,
    'points_max' => 99,
    'name' => self::_('Master of the Keeper'),
    'description' => self::_('Receive 1 point for each Gem in your reserve.') ),
  8 => array (
    'points' => 2,
    'points_max' => 6,
    'name' => self::_('Master of the Gems'),
    'description' => self::_('Receive 2 points for each Gem card in your hand. You can receive a maximum of 6 points.') ),
  9 => array (
    'points' => 1,
    'points_max' => 6,
    'name' => self::_('Master of the Resources'),
    'description' => self::_('Receive 1 point for each of your unused resources. You can receive a maximum of 6 points.') )
);

$this->golem_types = array (
  0 => clienttranslate('Any'),
  1 => clienttranslate('Time'),
  2 => clienttranslate('Blue'),
  3 => clienttranslate('Green'),
  4 => clienttranslate('Red'),
  5 => clienttranslate('Yellow')
);

$this->public_locations = array (
  "topleft",
  "topright",
  "bottomleft",
  "bottomright"
);

$this->player_locations = array (
    "rune" => array(3),  //Rune
    "blue" =>  array(1,3),  //No Gems
    "green" => array(1,3),  //No Gems
    "red"=>  array(1,3),  //No Gems
    "yellow"=> array(1,3),  //No Gems
    "golem"=>  array(1),  //Golem
    "golemdiscard"=> array(-1), //Special
    "gemdust"=> array(2), //Gem
    "gems"=> array(2)  //Gem
  );

$this->card_list = array (
  0 => array (
    'card_type' => 1,    //Golem
    'card_subtype' => 1, //Time
    'total_cost' => 7,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  1 => array (
    'card_type' => 1,       //Golem
    'card_subtype' => 1,    //Time
    'total_cost' => 7,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  2 => array (
    'card_type' => 1,       //Golem
    'card_subtype' => 1,    //Time
    'total_cost' => 7,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  3 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 1,    //Time
    'total_cost' => 7,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  4 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 0,
    'blue' => 2,
    'green'=> 0,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  5 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 3,
    'red' => 0,
    'blue' => 2,
    'green'=> 0,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  6 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 3,    //Master of Elements - Green
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 3, //Green
    'resource_type_2' => 3, //Green
    'solo_only' => false,
    'starting_card' => true ),

  7 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 5,    //Master of Elements - Yellow
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => 5, //Yellow
    'solo_only' => false,
    'starting_card' => true ),

  8 => array (
    'card_type' => 2,       //Gem  
    'card_subtype' => 1,    //Receive 3 Gems
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => -1,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  9 => array (
    'card_type' => 2,       //Gem 
    'card_subtype' => 3,    //Receive 1 Gem immediately and 2 points at the end of the game
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => -1,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  10 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 1,
    'red' => 0,
    'blue' => 3,
    'green'=> 1,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  11 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 0,
    'blue' => 3,
    'green'=> 2,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  12 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 0,
    'blue' => 2,
    'green'=> 3,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  13 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 0,
    'blue' => 2,
    'green'=> 1,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  14 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 0,
    'blue' => 1,
    'green'=> 2,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  15 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 2,    //Blue
    'total_cost' => 5,
    'yellow' => 1,
    'red' => 0,
    'blue' => 2,
    'green'=> 2,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  16 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 4,    //Master of Elements - Red
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 4, //Red
    'resource_type_2' => 4, //Red
    'solo_only' => false,
    'starting_card' => true ),

  17 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 2,    //Master of Elements - Blue
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => 2, //Blue
    'solo_only' => false,
    'starting_card' => true ),

  18 => array (
    'card_type' => 2,       //Gem 
    'card_subtype' => 2,    //Receive 2 Gems immediately and 1 point at the end of the game
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => -1,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  19 => array (
    'card_type' => 2,       //Gem 
    'card_subtype' => 6,    //Receive 2 Gems immediately. When summoning a Golem you can use this card as any resource, by discarding it from the game
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => -1,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  20 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 3,
    'red' => 1,
    'blue' => 1,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  21 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 2,
    'blue' => 1,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  22 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 3,
    'red' => 2,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  23 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 1,
    'red' => 2,
    'blue' => 2,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  24 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 3,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  25 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 1,
    'blue' => 2,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  26 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 1,    //Master of Elements - Time
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 0,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  27 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 6,    //Master Summoner (4 different golems)
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 3, //Green
    'resource_type_2' => 2, //Blue
    'solo_only' => false,
    'starting_card' => false ),

  28 => array (
    'card_type' => 2,       //Gem 
    'card_subtype' => 4,    //Receive 1 Gem immediately and take another turn
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => -1,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  29 => array (
    'card_type' => 2,       //Gem 
    'card_subtype' => 7,    //Receive 1 Gem immediately. Whenever you get both cards with this symbol you must take, in hand, the 2 cards discarded at the beginning of the game. Discard one and use the other at no cost
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => -1,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  30 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 0,
    'blue' => 3,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  31 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 5,    //Yellow
    'total_cost' => 5,
    'yellow' => 3,
    'red' => 0,
    'blue' => 2,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  32 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 2,
    'blue' => 2,
    'green'=> 1,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  33 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 2,
    'blue' => 1,
    'green'=> 2,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  34 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 2,
    'blue' => 0,
    'green'=> 3,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  35 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 1,
    'blue' => 2,
    'green'=> 2,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),
    
  36 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 8,    //Master Resources (unused resources)
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 2, //Blue
    'resource_type_2' => 5, //Yellow
    'solo_only' => false,
    'starting_card' => false ),

  37 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 8,    //Master Gems (gem CARDS)
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 5, //Yellow
    'resource_type_2' => 4, //Red
    'solo_only' => false,
    'starting_card' => false ),

  38 => array (
    'card_type' => 2,       //Gem 
    'card_subtype' => 8,    //Receive 1 Gem immediately. Whenever you get both cards with this symbol you must take, in hand, the 2 cards discarded at the beginning of the game. Discard one and use the other at no cost
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => -1,
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  40 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 3,
    'blue' => 0,
    'green'=> 2,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  41 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 2,
    'blue' => 3,
    'green'=> 0,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  42 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 3,
    'blue' => 1,
    'green'=> 1,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  43 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 4,    //Red
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 3,
    'blue' => 2,
    'green'=> 0,
    'resource_type_1' => 4, //Red
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  44 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 2,
    'blue' => 0,
    'green'=> 3,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  45 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 1,
    'blue' => 0,
    'green'=> 2,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  46 => array (
    'card_type' => 3,       //Rune
    'card_subtype' => 7,    //Master Keeper (gems remaining)
    'total_cost' => 0,
    'yellow' => 0,
    'red' => 0,
    'blue' => 0,
    'green'=> 0,
    'resource_type_1' => 3, //Greem
    'resource_type_2' => 4, //Red
    'solo_only' => false,
    'starting_card' => false ),

  50 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 3,
    'red' => 0,
    'blue' => 0,
    'green'=> 2,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  51 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 2,
    'blue' => 0,
    'green'=> 1,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  52 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 2,
    'red' => 0,
    'blue' => 0,
    'green'=> 3,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  53 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 1,
    'red' => 1,
    'blue' => 0,
    'green'=> 3,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  54 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 0,
    'red' => 3,
    'blue' => 0,
    'green'=> 2,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),

  55 => array(  
    'card_type' => 1,       //Golem
    'card_subtype' => 3,    //Green
    'total_cost' => 5,
    'yellow' => 1,
    'red' => 2,
    'blue' => 0,
    'green'=> 2,
    'resource_type_1' => 3, //Green
    'resource_type_2' => -1,
    'solo_only' => false,
    'starting_card' => false ),
);

//  39 => array (
//     'card_type' => 2,    //Gem 
//     'card_subtype' => 5, //Receive 1 Gem immediately.In this turn, you take 6 cards from the grid instead of 5
//     'total_cost' => 0,
//     'yellow' => 0,
//     'red' => 0,
//     'blue' => 0,
//     'green'=> 0,
//     'resource_type_1' => 0,
//     'resource_type_2' => 0,
//     'solo_only' => true ),
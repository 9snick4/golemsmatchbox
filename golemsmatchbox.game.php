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
  * golemsmatchbox.game.php
  *
  * This is the main file for your game logic.
  *
  * In this PHP file, you are going to defines the rules of the game.
  *
  */


require_once( APP_GAMEMODULE_PATH.'module/table/table.game.php' );


class GolemsMatchbox extends Table
{
	function __construct( )
	{
        // Your global variables labels:
        //  Here, you can assign labels to global variables you are using for this game.
        //  You can use any number of global variables with IDs between 10 and 99.
        //  If your game has options (variants), you also have to associate here a label to
        //  the corresponding ID in gameoptions.inc.php.
        // Note: afterwards, you can get/set the global variables with getGameStateValue/setGameStateInitialValue/setGameStateValue
        parent::__construct();
        self::initGameStateLabels( array( 
               "first_player" => 10,
               "available_gems" => 11,
            //      ...
            //    "my_first_game_variant" => 100,
            //    "my_second_game_variant" => 101,
            //      ...
        ) );  
        
        $this->cards = self::getNew( "module.common.deck" );
        $this->cards->init( "card" );

        

	}
	
    protected function getGameName( )
    {
		// Used for translations and stuff. Please do not modify.
        return "golemsmatchbox";
    }	

    /*
        setupNewGame:
        
        This method is called only once, when a new game is launched.
        In this method, you must setup the game according to the game rules, so that
        the game is ready to be played.
    */
    protected function setupNewGame( $players, $options = array() )
    {    
        // Set the colors of the players with HTML color code
        // The default below is red/green/blue/orange/brown
        // The number of colors defined here must correspond to the maximum number of players allowed for the gams
        $gameinfos = self::getGameinfos();
        $default_colors = $gameinfos['player_colors'];
 
        // Create players
        // Note: if you added some extra field on "player" table in the database (dbmodel.sql), you can initialize it there.
        $sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ";
        $values = array();
        foreach( $players as $player_id => $player )
        {
            $color = array_shift( $default_colors );
            $values[] = "('".$player_id."','$color','".$player['player_canal']."','".addslashes( $player['player_name'] )."','".addslashes( $player['player_avatar'] )."')";
        }
        $sql .= implode( $values, ',' );
        self::DbQuery( $sql );
        //self::reattributeColorsBasedOnPreferences( $players, $gameinfos['player_colors'] );
        self::reloadPlayersBasicInfos();
        
        /************ Start the game initialization *****/

        // Init global values with their initial values
        //self::setGameStateInitialValue( 'my_first_global_variable', 0 );

        //TODO Random First player
        $player_order = self::getNextPlayerTable();
        self::setGameStateInitialValue( 'first_player', $player_order[0] );
        self::setGameStateInitialValue( 'available_gems', $this->game_gems );
        
        //Giving gems to each player
        $sql = "UPDATE player SET player_gems = ".$this->starting_gems;
        self::DbQuery( $sql );
        $remaining_gems = $this->game_gems - ($this->starting_gems * count($players));

        self::setGameStateValue( 'available_gems', $remaining_gems);
        
        //create deck AND get starting cards
        //get all starting rune cards
        $starting_cards = array_filter( $this->card_list , function($val, $key) {
            return  $val['starting_card'] == true;
        }, ARRAY_FILTER_USE_BOTH );

        //get rune card 'type'
        $player1_starting_rune = array_rand( $starting_cards , 1 );
        $player2_starting_rune = array_rand( $starting_cards , 1 );
        while ($player1_starting_rune == $player2_starting_rune)
        {
            $player2_starting_rune = array_rand( $starting_cards , 1 );
        }

        //add cards to deck
        $cards = array();
        $card_ids = array_keys( $this->card_list );
        foreach($card_ids as $card_id)
        {
            //add it to deck
            $cards[] = array('type' => $card_id, 'type_arg'  => 0, 'nbr' => 1);

        } 
        $this->cards->createCards( $cards, 'deck' );
        $this->cards->shuffle( 'deck' );
        //retrieve rune card id from type
        $rune1_array = $this->cards->getCardsOfType($player1_starting_rune);
        $rune1 = reset($rune1_array);
        $player1_starting_rune = $rune1['id'];

        $rune2_array = $this->cards->getCardsOfType($player2_starting_rune);
        $rune2 = reset($rune2_array);
        $player2_starting_rune = $rune2['id'];
        
        $sql = "UPDATE player SET player_hand_count = 1";
        self::DbQuery( $sql );


        //This assumes there are only two players in the game. Usually a good assumption for a two player game BUT when we implement solo...
        reset($players);
        $this->cards->moveCard( $player1_starting_rune, 'rune', key($players) );
        next($players);
        $this->cards->moveCard( $player2_starting_rune, 'rune', key($players) );

        //discard two cards from deck
        $discard_1 = bga_rand( 1,count( $cards ) );        
        while ( $discard_1 == $player2_starting_rune || $discard_1 == $player1_starting_rune )
        {
            $discard_1 = bga_rand( 1,count( $cards ) );
        }

        $discard_2 = bga_rand(1,count($cards));        
        while ( $discard_2 == $player2_starting_rune || $discard_2 == $player1_starting_rune || $discard_1 == $discard_2 )
        {
            $discard_2 = bga_rand( 1,count( $cards ) );
        }
        $this->cards->playCard( $discard_1 );
        $this->cards->playCard( $discard_2 );

        //Prepare shared area
        $this->cards->pickCardForLocation( 'deck', 'topleft', 1 );
        $this->cards->pickCardForLocation( 'deck', 'topleft', 2 );
        $this->cards->pickCardForLocation( 'deck', 'topleft', 3 );
        
        $this->cards->pickCardForLocation( 'deck', 'topright', 1 );
        $this->cards->pickCardForLocation( 'deck', 'topright', 2 );
        $this->cards->pickCardForLocation( 'deck', 'topright', 3 );
        
        $this->cards->pickCardForLocation( 'deck', 'bottomleft', 1 );
        $this->cards->pickCardForLocation( 'deck', 'bottomleft', 2 );
        $this->cards->pickCardForLocation( 'deck', 'bottomleft', 3 );
        
        $this->cards->pickCardForLocation( 'deck', 'bottomright', 1 );
        $this->cards->pickCardForLocation( 'deck', 'bottomright', 2 );
        $this->cards->pickCardForLocation( 'deck', 'bottomright', 3 );




        // Init game statistics
        // (note: statistics used in this file must be defined in your stats.inc.php file)
        //self::initStat( 'table', 'table_teststat1', 0 );    // Init a table statistics
        //self::initStat( 'player', 'player_teststat1', 0 );  // Init a player statistics (for all players)

        // TODO: setup the initial game situation here
       

        // Activate first player (which is in general a good idea :) )
        $this->activeNextPlayer();

        /************ End of the game initialization *****/
    }

    /*
        getAllDatas: 
        
        Gather all informations about current game situation (visible by the current player).
        
        The method is called each time the game interface is displayed to a player, ie:
        _ when the game starts
        _ when a player refreshes the game page (F5)
    */
    protected function getAllDatas()
    {
        $result = array();
    
        $player_id = self::getCurrentPlayerId();    // !! We must only return informations visible by this player !!
    
        // Get information about players
        // Note: you can retrieve some extra field you added for "player" table in "dbmodel.sql" if you need it.
        $sql = "SELECT player_id id, player_score score, player_gems gems, player_hand_count hand_count FROM player ";
        $result['players'] = self::getCollectionFromDb( $sql );
  
        // TODO: Gather all information about current game situation (visible by player $current_player_id).
  
        
        // Cards in player hand (only used for rune card that picks up the 2 discarded cards)     
        $result['hand'] = $this->cards->getCardsInLocation( 'hand', $player_id );

        //Cards in player tableau
        //resource cards (Runes and Golems used as resources)
        $result['red'] = $this->cards->getCardsInLocation( 'red' );
        $result['blue'] = $this->cards->getCardsInLocation( 'blue' );
        $result['green'] = $this->cards->getCardsInLocation( 'green' );
        $result['yellow'] = $this->cards->getCardsInLocation( 'yellow' );
        
        //point cards (Gems used as gemdust and summoned)
        $result['gemdust'] = $this->cards->getCardsInLocation( 'gemdust' );
        $result['golem'] = $this->cards->getCardsInLocation( 'golem' );
        
        //Unplayable cards in player hand (objectives, which are Runes, and one-shots which have been already played, which are gems)
        $result['gems'] = $this->cards->getCardsInLocation( 'gem', $player_id );
        $result['runes'] = $this->cards->getCardsInLocation( 'rune', $player_id );

        //TODO - get all summoned golem card IDs, then foreach of those, get cards in location golemdiscard with that card id
        //this way we simulate the cards used to summon golem
        $result['golemdiscard'] = $this->cards->getCardsInLocation( 'golemdiscard', $player_id );
  
        // Cards available on the table
        $result['topleft'] = $this->cards->getCardsInLocation( 'topleft' );
        $result['topright'] = $this->cards->getCardsInLocation( 'topright' );
        $result['bottomleft'] = $this->cards->getCardsInLocation( 'bottomleft' );
        $result['bottomright'] = $this->cards->getCardsInLocation( 'bottomright' );


        $result['bank_gems'] = self::getGameStateValue( 'available_gems' );
        
        return $result;
    }

    /*
        getGameProgression:
        
        Compute and return the current game progression.
        The number returned must be an integer beween 0 (=the game just started) and
        100 (= the game is finished or almost finished).
    
        This method is called each time we are in a game state with the "updateGameProgression" property set to true 
        (see states.inc.php)
    */
    function getGameProgression()
    {
        // TODO: compute and return the game progression

        return 0;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Utility functions
////////////    

    /*
        In this space, you can put any utility methods useful for your game logic
    */
    //receives a deck card and an array of strings (locations)
    //returns true if card has one of the location as his own
    function isCardInLocations($card, $locations) {

        //lets check if we are using a deck card
        if(!array_key_exists('location', $card))
        {
            //maybe i passed the id?
            $card = $this->getCard($card);
        }
        //if locations is not array, maybe is string
        if(!is_array($locations))
        {
            $locations = array( $locations )
        }
        foreach($locations as $location)
        {
            if( !strcmp($card['location'], $location ) )
                return true;
        }
        return false;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Player actions
//////////// 

    /*
        Each time a player is doing some game action, one of the methods below is called.
        (note: each method below must match an input method in golemsmatchbox.action.php)
    */

    /*
    
    Example:

    function playCard( $card_id )
    {
        // Check that this is the player's turn and that it is a "possible action" at this game state (see states.inc.php)
        self::checkAction( 'playCard' ); 
        
        $player_id = self::getActivePlayerId();
        
        // Add your game logic to play a card there 
        ...
        
        // Notify all players about the card played
        self::notifyAllPlayers( "cardPlayed", clienttranslate( '${player_name} plays ${card_name}' ), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'card_name' => $card_name,
            'card_id' => $card_id
        ) );
          
    }
    
    */


    //////////////////////////////////////////////////////////////////////////////
    //////////// Action Validations
    //////////// 

    /*
        Each time an action is called, before perforing the action, these validations methods are called.

    */
    function canTakeCard( $card_id, $location_destination) 
    {
        self::checkAction("takeCard");
        $card_cost_or_income = 0;

        $sql = "SELECT player_id id, player_gems gems FROM player where player_id=".$player_id;
        $player = self::getObjectFromDb($sql);

        $card = $this->cards->getCard($card_id);
        $card_material = $this->card_list[$card['card_type']];

        //is card in a public locations?
        if(!isCardInLocations($card, $this->public_locations)) 
        {
            throw new BgaUserException( self::_("The 'selected' card is not available... What where you thinking, cheater? :P") );

        }

        //let's check if the card is going to a valid location       
        $valid_location = false;
        foreach($this->player_locations as $location_name => $location)
        {
            //if we are in the right location...
            if(!strcmp($location_name,$location_destination))
            {
                //let's check if the card is valid over there
                //location contains all the ids of the card types valid in the location
                foreach($location as $card_type_id)
                {
                    if($card_type_id == $card_material['card_type'])
                    {
                        $valid_location = true;
                        continue;
                    }
                }
                if($valid_location)
                {
                    continue;
                }
            }
        }
        
        if(!$valid_location) 
        {
            throw new BgaUserException( self::_("The selected card destination is not compatible with the card/orientation chosen") );
        }
        
        //how many cards in locations?
        $cards_in_location = $this->cards->getCardsInLocation($card['location']);
        switch(count($cards_in_location)) 
        {
            case 3:
                $card_cost_or_income = 2;
                break;
            case 2:
                $card_cost_or_income = 0;
                break;
            case 1:
                $card_cost_or_income = -2;
                break;
            default:
                throw new BgaVisibleSystemException ("The location has <1 or >3 cards");
                break;  
        }

        //retrieve rune type id
        $type_rune = 0;
        for($i = 1; $i <= count($this->card_types); $i++ ) 
        {
            $card_type = $this->card_types[$i];
            if(!strcmp($card_type['name'],'Rune'))
            {
                $type_rune = $i;
                continue;
            }

        }

        //if you're trying to buy a rune, you need to have three more gems. Of course, if you're taking two of them before you buy the rune,
        //that helps...
        if($card_material['card_type'] == $type_rune && !$orientation_isbottom)
        {
            $card_cost_or_income+=3;
        }
        if(!$player['gems'] >= $card_cost_or_income)
        {
            throw new BgaUserException( self::_("You do not have enough gems to take this card") );
        }
        

        //if you're trying to get a double resource, or a wild resource, you need to have somewhere to put it 
        //($card
        
    }
    
//////////////////////////////////////////////////////////////////////////////
//////////// Game state arguments
////////////

    /*
        Here, you can create methods defined as "game state arguments" (see "args" property in states.inc.php).
        These methods function is to return some additional information that is specific to the current
        game state.
    */

    /*
    
    Example for game state "MyGameState":
    
    function argMyGameState()
    {
        // Get some values from the current game situation in database...
    
        // return values:
        return array(
            'variable1' => $value1,
            'variable2' => $value2,
            ...
        );
    }    
    */

//////////////////////////////////////////////////////////////////////////////
//////////// Game state actions
////////////

    /*
        Here, you can create methods defined as "game state actions" (see "action" property in states.inc.php).
        The action method of state X is called everytime the current game state is set to X.
    */
    
    /*
    
    Example for game state "MyGameState":

    function stMyGameState()
    {
        // Do some stuff ...
        
        // (very often) go to another gamestate
        $this->gamestate->nextState( 'some_gamestate_transition' );
    }    
    */

//////////////////////////////////////////////////////////////////////////////
//////////// Zombie
////////////

    /*
        zombieTurn:
        
        This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
        You can do whatever you want in order to make sure the turn of this player ends appropriately
        (ex: pass).
        
        Important: your zombie code will be called when the player leaves the game. This action is triggered
        from the main site and propagated to the gameserver from a server, not from a browser.
        As a consequence, there is no current player associated to this action. In your zombieTurn function,
        you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message. 
    */

    function zombieTurn( $state, $active_player )
    {
    	$statename = $state['name'];
    	
        if ($state['type'] === "activeplayer") {
            switch ($statename) {
                default:
                    $this->gamestate->nextState( "zombiePass" );
                	break;
            }

            return;
        }

        if ($state['type'] === "multipleactiveplayer") {
            // Make sure player is in a non blocking status for role turn
            $this->gamestate->setPlayerNonMultiactive( $active_player, '' );
            
            return;
        }

        throw new feException( "Zombie mode not supported at this game state: ".$statename );
    }
    
///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
        upgradeTableDb:
        
        You don't have to care about this until your game has been published on BGA.
        Once your game is on BGA, this method is called everytime the system detects a game running with your old
        Database scheme.
        In this case, if you change your Database scheme, you just have to apply the needed changes in order to
        update the game database and allow the game to continue to run with your new version.
    
    */
    
    function upgradeTableDb( $from_version )
    {
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        
        // Example:
//        if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here
//
//


    }    
}

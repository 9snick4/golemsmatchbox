/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * GolemsMatchbox implementation : © Stefano Nicotra 9stefanonicotra4@gmail.com
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * golemsmatchbox.js
 *
 * GolemsMatchbox user interface script
 * 
 * In this file, you are describing the logic of your user interface, in Javascript language.
 *
 */

define([
    "dojo","dojo/_base/declare",
    "ebg/core/gamegui",
    "ebg/counter",
    "ebg/stock",
    "ebg/zone"
],
function (dojo, declare) {
    return declare("bgagame.golemsmatchbox", ebg.core.gamegui, {
        constructor: function(){
            console.log('golemsmatchbox constructor');
              
            // Here, you can init the global variables of your user interface
            // Example:
            // this.myGlobalValue = 0;
            this.cardwidth = 96;
            this.cardheight = 148;
            this.imagesPerRow = 10;
            this.selectable_cards;
            this.card_types;
            this.card_list;
            this.golem_types;
        },
        
        /*
            setup:
            
            This method must set up the game user interface according to current game situation specified
            in parameters.
            
            The method is called each time the game interface is displayed to a player, ie:
            _ when the game starts
            _ when a player refreshes the game page (F5)
            
            "gamedatas" argument contains all datas retrieved by your "getAllDatas" PHP method.
        */
        
        setup: function( gamedatas )
        {
            console.log( "Starting game setup" );
            
            this.selectable_cards = new Array();
            this.card_types = gamedatas.card_types;
            this.card_list = gamedatas.card_list;
            this.golem_types = gamedatas.golem_types;

            // Setting up player boards
            for( var player_id in gamedatas.players )
            {
                var player = gamedatas.players[player_id];
                         
                // TODO: Setting up players boards if needed
                var player_board_div = $('player_board_'+player_id);
                dojo.place( this.format_block('jstpl_player_board', {
                    id: player.id,
                    num: player.id % 2,
                    gems: player.gems,
                    hand_count: player.hand_count
                } ), player_board_div );
            }
            
            // TODO: Set up your game interface here, according to "gamedatas"
            
            //Setting up the 4 golem zones
            //topleft
            for( var id in gamedatas.topleft ) {
                var card = gamedatas.topleft[id];
                this.moveCard(card, 'golem_deck', 'topleft_'+card.location_arg);
                dojo.query('#faceupcard_'+card.id).connect('onclick', this, 'onFaceupCard');
            }

            //topright
            for( var id in gamedatas.topright ) {
                var card = gamedatas.topright[id];
                this.moveCard(card, 'golem_deck', 'topright_'+card.location_arg);
                dojo.query('#faceupcard_'+card.id).connect('onclick', this, 'onFaceupCard');
            }

            //bottomleft
            for( var id in gamedatas.bottomleft ) {
                var card = gamedatas.bottomleft[id];
                this.moveCard(card, 'golem_deck', 'bottomleft_'+card.location_arg);
                dojo.query('#faceupcard_'+card.id).connect('onclick', this, 'onFaceupCard');
            }

            //bottomright
            for( var id in gamedatas.bottomright ) {
                var card = gamedatas.bottomright[id];
                this.moveCard(card, 'golem_deck', 'bottomright_'+card.location_arg);
                dojo.query('#faceupcard_'+card.id).connect('onclick', this, 'onFaceupCard');
            }

            // Player hand
            var hand_id = 0;
            for( var id in gamedatas.runes ) {
                var card = gamedatas.runes[id];
                this.moveCard(card, 'golem_deck', 'my_hand_'+hand_id);
                hand_id++;
                // dojo.query('#faceup_card_'+card.card_id).connect('onclick', this, 'onFaceupCard');
            }

            for( var id in gamedatas.gems ) {
                var card = gamedatas.gems[id];
                this.moveCard(card, 'golem_deck', 'my_hand_'+hand_id);
                hand_id++;
                // dojo.query('#faceup_card_'+card.card_id).connect('onclick', this, 'onFaceupCard');
            }

            //bank gems
            for(var i = 0; i < gamedatas.bank_gems; i++)
            {
                this.moveGem(i,'golem_deck', 'bank_gem_'+i);
            }


            // // Create cards types:
            // for (var row = 1; row <= 4; row++) {
            //     for (var value = 2; value <= 14; value++) {
            //         // Build card type id
            //         var card_type_id = this.getCardPosition(row, value, this.playerHand.image_items_per_row);
            //         this.playerHand.addItemType(card_type_id, card_type_id, g_gamethemeurl + 'img/cards.jpg', card_type_id);
            //     }
            // }

            this.setupNotifications();

            
            // Setup game notifications to handle (see "setupNotifications" method below)
            
            // dojo.connect( this.playerHand, 'onChangeSelection', this, 'onPlayerHandSelectionChanged' );

            // this.setupNotifications();

            console.log( "Ending game setup" );
        },
       

        ///////////////////////////////////////////////////
        //// Game & client states
        
        // onEnteringState: this method is called each time we are entering into a new game state.
        //                  You can use this method to perform some user interface changes at this moment.
        //
        onEnteringState: function( stateName, args )
        {
            console.log( 'Entering state: '+stateName );
            switch( stateName )
            {
            
            /* Example:
            
            case 'myGameState':
            
                // Show some HTML block at this game state
                dojo.style( 'my_html_block_id', 'display', 'block' );
                
                break;
           */
            case 'chooseCard':
                if(this.isCurrentPlayerActive())
                {
                    for(var card of args.args.selectable_cards)
                    {
                        this.selectable_cards.push(card);
                        dojo.query('#faceupcard_'+card.id).addClass('selectable');
                    }
                }
                break;
           
            case 'dummmy':
                break;
            }
        },

        // onLeavingState: this method is called each time we are leaving a game state.
        //                 You can use this method to perform some user interface changes at this moment.
        //
        onLeavingState: function( stateName )
        {
            console.log( 'Leaving state: '+stateName );
            
            switch( stateName )
            {
            
            /* Example:
            
            case 'myGameState':
            
                // Hide the HTML block we are displaying only during this game state
                dojo.style( 'my_html_block_id', 'display', 'none' );
                
                break;
           */
           
           
            case 'dummmy':
                break;
            }               
        }, 

        // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
        //                        action status bar (ie: the HTML links in the status bar).
        //        
        onUpdateActionButtons: function( stateName, args )
        {
            console.log( 'onUpdateActionButtons: '+stateName );
                      
            if( this.isCurrentPlayerActive() )
            {            
                switch( stateName )
                {
/*               
                 Example:
 
                 case 'myGameState':
                    
                    // Add 3 action buttons in the action status bar:
                    
                    this.addActionButton( 'button_1_id', _('Button 1 label'), 'onMyMethodToCall1' ); 
                    this.addActionButton( 'button_2_id', _('Button 2 label'), 'onMyMethodToCall2' ); 
                    this.addActionButton( 'button_3_id', _('Button 3 label'), 'onMyMethodToCall3' ); 
                    break;
*/
                }
            }
        },        

        onFaceupCard:function(event)
        {
            
            dojo.stopEvent(event);
            if(this.isCurrentPlayerActive()) {
                if(event.currentTarget.classList.contains('selectable')) {
                    // Discarding cards
                    if(this.gamedatas.gamestate.name == 'chooseCard') {
                        if(this.checkAction("takeCard")) {
                            //determine location destination through card type and orientation choice
                            var card = this.selectable_cards.find(sel_card => sel_card.id == event.currentTarget.id.substr(11));
                            var orientation = event.offsetY >= 74 ? "bottom":"top";
                            var card_material = this.card_list[card.type];
                            var type = this.card_types[card_material.card_type];
                            var location_destination = type[orientation];
                            //if resource, we need to discover where as a resource... 
                            if(location_destination == 'resource') {
                                //TODO
                                //if rune, we first check for available spots
                                //if multiple spots, he needs to choose

                                //if golem, easy peasy, color of resource is location destination
                                if(type["name"] == "Golem") {
                                    var sub_type = card_material.resource_type_1;
                                    location_destination = this.golem_types[sub_type];
                                }
                            }
                            this.ajaxcall('/golemsmatchbox/golemsmatchbox/takeCard.html', {
                                    lock:true,
                                    card_id:event.currentTarget.id.substr(11),
                                    location_destination:location_destination
                                },this, function( result ) {
                                }, function( is_error ) { } );
                        }
                    }

                    // Take a faceup card
                    if(this.gamedatas.gamestate.name == 'play_action') {
                        if(this.checkAction("takeFaceupCard")) {
                            this.ajaxcall('/fifteendays/fifteendays/takeFaceupCard.html', {
                                    lock:true,
                                    card_id:event.currentTarget.id
                                },this, function( result ) {
                                }, function( is_error ) { } );
                        }
                    }

                }
            }
        },
        ///////////////////////////////////////////////////
        //// Utility methods
        
        /*
        
            Here, you can defines some utility methods that you can use everywhere in your javascript
            script.
        
        */
        // getCardPosition : function(cardId) {
        //     return (color - 1) * rowLength + (value - 2);
        // },
        isHidden: function() 
        {
            return true;
        },

        moveCard: function(card, origin, target)
        {
            if(origin == null) {
                origin = 'golem_deck';
            }
            var id;
            if(this.isHidden()) {
                // Move a visible card
                id = "faceupcard_"+card.id;
                if(dojo.byId(id) == null) {
                    dojo.place(this.format_block('jstpl_faceupcard', 
                        {card_id: card.id,
                        x: (card.type%this.imagesPerRow)*this.cardwidth, 
                        y: (parseInt(card.type/this.imagesPerRow))*this.cardheight}), $(origin));
                }
            } else {
                // Move a hidden card
                id = "facedowncard_"+card.id;
                if(dojo.byId(id) == null) {
                    dojo.place(this.format_block('jstpl_facedowncard', {card_id: card.id}), $(origin));
                }
            }

            console.log("id:"+id);
            console.log("target:"+target);

            this.attachToNewParent(id, target);
            this.slideToObjectPos(id, target, 0, 0, 50, 50).play();
            // this.addTooltipHtml( id, this.format_block('jstpl_tooltip_common', {title: _(this.translatableTexts.tooltip_energy_title)+" : "+_(this.colors[energy.color]), description: _(this.translatableTexts.tooltip_energy_description) }));
            // dojo.query('#'+id).connect('onclick', this, 'onEnergyMaya'); 
        },

        moveGem: function(gem_id, origin, target, bottomright = false) {
            if(origin == null) {
                origin = 'golem_deck';
            }
            var id = "gem_"+gem_id;
            if(dojo.byId(id) == null) {
                dojo.place(this.format_block('jstpl_gem', 
                    {id: gem_id,
                     num: gem_id % 3}), $(origin));
            }

            var x = 0;
            var y = 0;
            if(bottomright) {
                x = 50;
                y = 50;
            }
            this.attachToNewParent(id, target);
            this.slideToObjectPos(id, target, x, y, 50, 50).play();
        },

        ///////////////////////////////////////////////////
        //// Player's action
        
        /*
        
            Here, you are defining methods to handle player's action (ex: results of mouse click on 
            game objects).
            
            Most of the time, these methods:
            _ check the action is possible at this game state.
            _ make a call to the game server
        
        */
        
        /* Example:
        
        onMyMethodToCall1: function( evt )
        {
            console.log( 'onMyMethodToCall1' );
            
            // Preventing default browser reaction
            dojo.stopEvent( evt );

            // Check that this action is possible (see "possibleactions" in states.inc.php)
            if( ! this.checkAction( 'myAction' ) )
            {   return; }

            this.ajaxcall( "/golemsmatchbox/golemsmatchbox/myAction.html", { 
                                                                    lock: true, 
                                                                    myArgument1: arg1, 
                                                                    myArgument2: arg2,
                                                                    ...
                                                                 }, 
                         this, function( result ) {
                            
                            // What to do after the server call if it succeeded
                            // (most of the time: nothing)
                            
                         }, function( is_error) {

                            // What to do after the server call in anyway (success or failure)
                            // (most of the time: nothing)

                         } );        
        },        
        
        */
        onPlayerHandSelectionChanged : function() {
            var items = this.playerHand.getSelectedItems();

            if (items.length > 0) {
                if (this.checkAction('playCard', true)) {
                    // Can play a card

                    var card_id = items[0].id;
                    console.log("on playCard "+card_id);

                    this.playerHand.unselectAll();
                } else if (this.checkAction('giveCards')) {
                    // Can give cards => let the player select some cards
                } else {
                    this.playerHand.unselectAll();
                }
            }
        },
        
        ///////////////////////////////////////////////////
        //// Reaction to cometD notifications

        /*
            setupNotifications:
            
            In this method, you associate each of your game notifications with your local method to handle it.
            
            Note: game notification names correspond to "notifyAllPlayers" and "notifyPlayer" calls in
                  your golemsmatchbox.game.php file.
        
        */
        setupNotifications: function()
        {
            dojo.subscribe('cardTaken', this, "notif_cardTaken");
            dojo.subscribe('placeGems', this, "notif_placeGems");
            dojo.subscribe('moveGems', this, "notif_moveGems");

            // TODO: here, associate your game notifications with local methods
            
            // Example 1: standard notification handling
            // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
            
            // Example 2: standard notification handling + tell the user interface to wait
            //            during 3 seconds after calling the method in order to let the players
            //            see what is happening in the game.
            // dojo.subscribe( 'cardPlayed', this, "notif_cardPlayed" );
            // this.notifqueue.setSynchronous( 'cardPlayed', 3000 );
            // 
        },  
        
        // TODO: from this point and below, you can write your game notifications handling methods
        
        /*
        Example:
        
        notif_cardPlayed: function( notif )
        {
            console.log( 'notif_cardPlayed' );
            console.log( notif );
            
            // Note: notif.args contains the arguments specified during you "notifyAllPlayers" / "notifyPlayer" PHP call
            
            // TODO: play the card in the user interface.
        },    
        
        */
        notif_placeGems: function(notif) {
            var player_id = notif.args.player_id;
            var location_origin = notif.args.location_origin;
            var cards = notif.args.cards;
            var gemId = notif.args.gems_on_table;
            for ( var prop in cards) {
                var id = cards[prop].id;
                //TODO origin player square?
                this.moveGem(gemId, null,'faceupcard_'+id);
                gemId++;
            }

        },

        notif_moveGems: function(notif) {
            debugger;
            var player_id = notif.args.player_id;
            var location_origin = notif.args.location_origin;
            var source_card = notif.args.source_card;
            var destination_card_id = notf.args.destination_card_id;
            for ( var prop in source_card) {
                var id = cards[prop].id;
                //TODO origin player square?
                var gem =dojo.query("#faceupcard_"+id + " .gem");
                var gemelem = gem.first();
                var gemId = gemelem.id;
                this.moveGem(gemId, null,'faceupcard_'+destination_card_id);
                gemId++;
            }

        },

       notif_cardTaken: function(notif) {

           var card_id = notif.args.card_id;
           var location_destination = notif.args.location_destination;
           var player_id = notif.args.player_id;
           var index = notif.args.index;
            var card = {
                id :card_id
            };
            var target;

            //trovare origine di carta
            var origin = "null";
            if(this.isCurrentPlayerActive()) {
                target = 'my_'+location_destination + '_'+ index
            }
            else {
                target = 'opponent_'+location_destination + '_'+ index

            }
           this.moveCard(card,origin,target);

       }
   });             
});

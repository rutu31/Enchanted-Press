// The current version of this code is always available at:
// http://www.acme.com/javascript/
//
//
// Copyright © 2006 by Jef Poskanzer <jef@mail.acme.com>.
// All rights reserved.
//
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions
// are met:
// 1. Redistributions of source code must retain the above copyright
//    notice, this list of conditions and the following disclaimer.
// 2. Redistributions in binary form must reproduce the above copyright
//    notice, this list of conditions and the following disclaimer in the
//    documentation and/or other materials provided with the distribution.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR AND CONTRIBUTORS ``AS IS'' AND
// ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
// IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
// ARE DISCLAIMED.  IN NO EVENT SHALL THE AUTHOR OR CONTRIBUTORS BE LIABLE
// FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
// DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS
// OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
// HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
// LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
// OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
// SUCH DAMAGE.
//
// For commentary on this license please see http://www.acme.com/license.html


Tabs = function ( element )
    {
    this.element = element;

    // We create the following structure inside the supplied element:
    // <table border="0" cellpadding="0" cellspacing="0">
    //   <tbody>
    //     <tr>
    //       <td align="left">
    //         <table border="0" cellpadding="5" cellspacing="0">
    //           <tbody>
    //             <tr>
    //               <td>&nbsp;</td>
    //               (tabs go here)
    //               <td>&nbsp;</td>
    //             </tr>
    //           </tbody>
    //         </table>
    //       </td>
    //     </tr>
    //     <tr>
    //       <td>
    //         (panels go here)
    //       </td>
    //     </tr>
    //   </tbody>
    // </table>

    var table1Element = document.createElement( 'table' );
    table1Element.border = '0';
    table1Element.cellPadding = '0';
    table1Element.cellSpacing = '0';
    element.appendChild( table1Element );

    var tbody1Element = document.createElement( 'tbody' );
    table1Element.appendChild( tbody1Element );

    var tr1Element = document.createElement( 'tr' );
    tbody1Element.appendChild( tr1Element );

    var td1Element = document.createElement( 'td' );
    td1Element.align = 'left';
    tr1Element.appendChild( td1Element );

    var table2Element = document.createElement( 'table' );
    table2Element.border = '0';
    table2Element.width = '100%';
    table2Element.cellPadding = '5';
    table2Element.cellSpacing = '0';
    td1Element.appendChild( table2Element );

    var tbody2Element = document.createElement( 'tbody' );
    table2Element.appendChild( tbody2Element );

    var tr2Element = document.createElement( 'tr' );
    tbody2Element.appendChild( tr2Element );

    var td2Element = document.createElement( 'td' );
    td2Element.style.cssText = Tabs.paddingStyle;
    td2Element.width = "100%";
    td2Element.innerHTML = Tabs.paddingStr;
    tr2Element.appendChild( td2Element );

    var tr3Element = document.createElement( 'tr' );
    tbody1Element.appendChild( tr3Element );

    var td4Element = document.createElement( 'td' );
    td4Element.style.cssText = Tabs.panesStyle;
    tr3Element.appendChild( td4Element );

    this.tabsElement = tr2Element;
    this.paddingElement = td2Element;
    this.panesElement = td4Element;

    this.items = [];
    this.activeItem = null;
    };


Tabs.activeTabStyle = 'white-space: nowrap; margin: 0; border: 1px solid #000000; border-bottom-width: 0;';
Tabs.inactiveTabStyle = 'white-space: nowrap; margin: 0; border: 1px solid #000000;';
Tabs.paddingStyle = 'margin: 0; border: 0 solid #000000; border-bottom-width: 1px;';
Tabs.panesStyle = 'margin: 0; border: 1px solid #000000; border-top-width: 0; padding: 1em;';
Tabs.paddingStr = '&nbsp;';

Tabs.globalItems = [];


Tabs.prototype.Add = function ( name, activateCallback )
    {
    var globalItemId = Tabs.globalItems.length;

    var padElement = document.createElement( 'td' );
    padElement.style.cssText = Tabs.paddingStyle;
    padElement.innerHTML = Tabs.paddingStr;
    this.tabsElement.insertBefore( padElement, this.paddingElement );

    var tabElement = document.createElement( 'td' );
    tabElement.style.cssText = Tabs.inactiveTabStyle;
    tabElement.innerHTML = '<a class = "a-tabs" href="javascript:Tabs.Switch(' + globalItemId + ')">' + name + '</a>';
    this.tabsElement.insertBefore( tabElement, this.paddingElement );

    var paneElement = document.createElement( 'div' );

    var item = new Tabs.Item( this, name, activateCallback, tabElement, paneElement );
    this.items.push( item );
    Tabs.globalItems.push( item );
    if ( this.items.length == 1 )
	item.Activate();
    };


Tabs.Item = function ( parent, name, activateCallback, tabElement, paneElement )
    {
    this.parent = parent;
    this.name = name;
    this.activateCallback = activateCallback;
    this.tabElement = tabElement;
    this.paneElement = paneElement;
    };


Tabs.Item.prototype.Activate = function ()
    {
    if ( this.parent.activeItem != null )
	{
	this.parent.activeItem.tabElement.style.cssText = Tabs.inactiveTabStyle;
	this.parent.panesElement.removeChild( this.parent.activeItem.paneElement );
	}
    this.parent.activeItem = this;
    this.tabElement.style.cssText = Tabs.activeTabStyle;
    this.parent.panesElement.appendChild( this.paneElement );
    this.activateCallback( this.paneElement );
    };


Tabs.Switch = function ( globalItemId )
    {
    Tabs.globalItems[globalItemId].Activate();
    };

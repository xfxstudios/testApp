import React, { Component } from 'react';
import {StackNavigator, TabNavigator, DrawerNavigator, NavigationActions} from 'react-navigation';
import Home from './screens/Home';

export const HomeStack = StackNavigator({
    Inicio:{
        screen:Home
    },
    contactos:{
        screen:Contacts
    }
},{
        headerMode:'none'
})
export const SideMenu = DrawerNavigator({
    home:{
        screen:HomeStack
    }
},{
    drawerWidth: 300,
    drawerPosition: 'left',
    contentComponent: props => <Menu {...props}/>
})
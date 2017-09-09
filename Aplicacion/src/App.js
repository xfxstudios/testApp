import React, {Component} from 'react';
import {View, Text} from 'react-native';
import {SideMenu} from './Router';

export default class App extends Component {
    static navigationOptions = {
        headerMode: 'none'
    }
    render() {
    return (
        <SideMenu/>
        );
    }
}
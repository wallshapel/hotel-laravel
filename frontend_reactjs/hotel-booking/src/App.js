// src/App.js
import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { RoomProvider } from './context/RoomContext';
import RoomList from './components/RoomList';

function App() {
    return (
        <Router>
            <RoomProvider>
                <Routes>
                    <Route path="/" element={<RoomList />} />
                </Routes>
            </RoomProvider>
        </Router>
    );
}

export default App;

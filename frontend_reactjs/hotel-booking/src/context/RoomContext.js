// src/context/RoomContext.js
import React, { createContext, useState, useEffect } from 'react';
import axios from 'axios';

const RoomContext = createContext();

const RoomProvider = ({ children }) => {
    const [rooms, setRooms] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    const fetchAvailableRooms = async (checkInDate, checkOutDate) => {
        setLoading(true);
        try {
            const response = await axios.post('http://localhost:8000/api/v1/rooms/available', {
                check_in_date: checkInDate,
                check_out_date: checkOutDate
            });
            setRooms(response.data);
            setError(null);
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    const calculateCancellationRate = async (roomCode, seasonName, checkinDate, checkoutDate, numPeople) => {
        try {
            const response = await axios.post('http://localhost:8000/api/v1/rooms/calculate-cancellation-rate', {
                room_code: roomCode,
                season_name: seasonName,
                checkin_date: checkinDate,
                checkout_date: checkoutDate,
                num_people: numPeople
            });
            return response.data.total_cost;
        } catch (err) {
            throw new Error(err.response.data.error || err.message);
        }
    };

    return (
        <RoomContext.Provider value={{ rooms, loading, error, fetchAvailableRooms, calculateCancellationRate }}>
            {children}
        </RoomContext.Provider>
    );
};

export { RoomContext, RoomProvider };

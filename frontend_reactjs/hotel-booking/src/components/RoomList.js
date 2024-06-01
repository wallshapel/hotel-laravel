import React, { useContext, useState } from 'react';
import { RoomContext } from '../context/RoomContext';
import RoomItem from './RoomItem';

const RoomList = () => {
    const { rooms, loading, error, fetchAvailableRooms } = useContext(RoomContext);
    const [checkInDate, setCheckInDate] = useState('');
    const [checkOutDate, setCheckOutDate] = useState('');
    const [searched, setSearched] = useState(false);

    const handleSearch = () => {
        fetchAvailableRooms(checkInDate, checkOutDate);
        setSearched(true);
    };

    return (
        <div>
            <h1>Available Rooms</h1>
            <label>
                General Check-in Date:
                <input
                    type="date"
                    value={checkInDate}
                    onChange={(e) => setCheckInDate(e.target.value)}
                    placeholder="Check-in Date"
                />
            </label>
            <label>
                General Check-out Date:
                <input
                    type="date"
                    value={checkOutDate}
                    onChange={(e) => setCheckOutDate(e.target.value)}
                    placeholder="Check-out Date"
                />
            </label>
            <button onClick={handleSearch}>Search</button>

            {error && searched && <p>Error: {error}</p>}
            {searched && !loading && rooms.length === 0 && <p>No rooms available for the selected dates.</p>}
            <div>
                {rooms.map((room) => (
                    <RoomItem key={room.room_code} room={room} />
                ))}
            </div>
        </div>
    );
};

export default RoomList;

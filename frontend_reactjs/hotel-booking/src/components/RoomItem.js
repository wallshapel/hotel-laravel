// src/components/RoomItem.js
import React, { useContext, useState } from 'react';
import { RoomContext } from '../context/RoomContext';

const RoomItem = ({ room }) => {
    const { calculateCancellationRate } = useContext(RoomContext);
    const [checkinDate, setCheckinDate] = useState('');
    const [checkoutDate, setCheckoutDate] = useState('');
    const [numPeople, setNumPeople] = useState(1);
    const [seasonName, setSeasonName] = useState(room.room_prices[0].season);
    const [cost, setCost] = useState(null);
    const [error, setError] = useState(null);

    const handleCalculate = async () => {
        try {
            const totalCost = await calculateCancellationRate(room.room_code, seasonName, checkinDate, checkoutDate, numPeople);
            setCost(totalCost);
            setError(null);
        } catch (err) {
            setError(err.message);
            setCost(null);
        }
    };

    return (
        <div>
            <h2>{room.hotel} - {room.room}</h2>
            <p>Location: {room.hotel_locality}</p>
            <p>Capacity: {room.room_capacity}</p>
            <p>Prices:</p>
            <ul>
                {room.room_prices.map((price, index) => (
                    <li key={index}>
                        {price.season}: {price.value} (from {price.start_date} to {price.end_date})
                    </li>
                ))}
            </ul>
            <div>
                <label>
                    Check-in Date:
                    <input
                        type="date"
                        value={checkinDate}
                        onChange={(e) => setCheckinDate(e.target.value)}
                        placeholder="Check-in Date"
                    />
                </label>
                <label>
                    Check-out Date:
                    <input
                        type="date"
                        value={checkoutDate}
                        onChange={(e) => setCheckoutDate(e.target.value)}
                        placeholder="Check-out Date"
                    />
                </label>
                <label>
                    Number of People:
                    <input
                        type="number"
                        value={numPeople}
                        onChange={(e) => setNumPeople(e.target.value)}
                        placeholder="Number of People"
                    />
                </label>
                <label>
                    Season:
                    <select value={seasonName} onChange={(e) => setSeasonName(e.target.value)}>
                        {room.room_prices.map((price, index) => (
                            <option key={index} value={price.season}>
                                {price.season}
                            </option>
                        ))}
                    </select>
                </label>
                <button onClick={handleCalculate}>Calculate Cost</button>
                {cost !== null && <p>Total Cost: {cost}</p>}
                {error && <p>Error: {error}</p>}
            </div>
        </div>
    );
};

export default RoomItem;

import React, { useState } from 'react';
import axios from 'axios';

const Analytics = () => {
    const [file, setFile] = useState<File | null>(null);
    const [saveToDb, setSaveToDb] = useState<boolean>(false);
    const [stats, setStats] = useState<any | null>(null);
    const [error, setError] = useState<string | null>(null);
    const [loading, setLoading] = useState<boolean>(false);

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        if (e.target.files && e.target.files[0]) {
            setFile(e.target.files[0]);
        }
    };

    const toggleSaveToDb = () => setSaveToDb(prev => !prev);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        if (!file) {
            setError('Please select a file.');
            return;
        }

        setError(null);
        setStats(null);
        setLoading(true);

        const formData = new FormData();
        formData.append('file', file);
        formData.append('save_to_db', saveToDb ? '1' : '0');

        try {
            const response = await axios.post('/api/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            setStats(response.data.data);
        } catch (err: any) {
            if (err.response?.data?.message) {
                setError(err.response.data.message);
            } else {
                setError('Something went wrong while uploading the file.');
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <div>
            <form onSubmit={handleSubmit}>
                <div>
                    <input type="file" accept=".csv" onChange={handleFileChange} />
                </div>
                <div>
                    <label>
                        <input
                            type="checkbox"
                            checked={saveToDb}
                            onChange={toggleSaveToDb}
                        /> Save to database
                    </label>
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>

            {loading && <p>Uploading...</p>}

            {error && <p style={{ color: 'red' }}>{error}</p>}

            {stats && (
                <div style={{ marginTop: '1rem' }}>
                    <p><strong>Avg price:</strong> {stats.avg_price}</p>
                    <p><strong>Total houses sold:</strong> {stats.total_houses_sold}</p>
                    <p><strong>No of crimes in 2011:</strong> {stats.crimes_2011}</p>
                    <p><strong>Avg price per year in London area</strong></p>
                    <ul>
                        {Object.entries(stats.london_avg_price_per_year).map(([year, price]) => (
                            <li key={year}>{year}: {price}</li>
                        ))}
                    </ul>
                </div>
            )}
        </div>
    );
};

export default Analytics;

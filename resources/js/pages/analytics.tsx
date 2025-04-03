import React, { useState } from 'react';
import axios from 'axios';

type HousingStats = {
    avg_price: number;
    total_houses_sold: number;
    crimes_2011: number;
    london_avg_price_per_year: Record<string, number>;
};

const Analytics = () => {
    const [file, setFile] = useState<File | null>(null);
    const [saveToDb, setSaveToDb] = useState<boolean>(false);
    const [stats, setStats] = useState<HousingStats | null>(null);
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
            const response = await axios.post<{ data: HousingStats }>('/api/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            setStats(response.data.data);
        } catch (err: unknown) {
            if (axios.isAxiosError(err)) {
                setError(err.response?.data?.message || 'Something went wrong while uploading the file.');
            } else {
                setError('Unexpected error occurred.');
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="max-w-2xl mx-auto p-6">
            <form onSubmit={handleSubmit} className="bg-white p-6 rounded-lg shadow-md space-y-4">
                <div>
                    <input
                        type="file"
                        accept=".csv"
                        onChange={handleFileChange}
                        className="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0 file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    />
                </div>

                <div className="flex items-center space-x-2">
                    <input
                        type="checkbox"
                        checked={saveToDb}
                        onChange={toggleSaveToDb}
                        id="saveToDb"
                        className="accent-blue-600"
                    />
                    <label htmlFor="saveToDb" className="text-sm text-gray-800">Save to database</label>
                </div>

                <div>
                    <button
                        type="submit"
                        className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                    >
                        {loading ? 'Uploading...' : 'Submit'}
                    </button>
                </div>
            </form>

            {error && <p className="mt-4 text-red-600 font-medium">{error}</p>}

            {stats && (
                <div className="mt-6 bg-white p-6 rounded-lg shadow-md space-y-4">
                    <h2 className="text-xl font-semibold text-gray-800">📊 Statistics</h2>
                    <p><strong>Avg price:</strong> £{stats.avg_price.toLocaleString()}</p>
                    <p><strong>Total houses sold:</strong> {stats.total_houses_sold.toLocaleString()}</p>
                    <p><strong>No of crimes in 2011:</strong> {stats.crimes_2011.toLocaleString()}</p>

                    <div>
                        <p className="font-semibold mb-2">Avg price per year in London area:</p>
                        <ul className="list-disc pl-5 text-gray-700">
                            {Object.entries(stats.london_avg_price_per_year).map(([year, price]) => (
                                <li key={year}>{year}: £{price.toLocaleString()}</li>
                            ))}
                        </ul>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Analytics;

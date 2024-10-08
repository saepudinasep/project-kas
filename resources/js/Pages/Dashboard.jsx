import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import Pagination from '@/Components/Pagination';

export default function Dashboard({ auth, dataAll }) {
    console.log(dataAll); // Debugging: Check data structure in the console
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="overflow-auto">
                                <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                                        <tr className="text-nowrap">
                                            <th className="px-3 py-3">NO</th>
                                            <th className="px-3 py-3">Region Name</th>
                                            <th className="px-3 py-3">Branch Name</th>
                                            <th className="px-3 py-3">Full Name</th>
                                            <th className="px-3 py-3">NIK</th>
                                            <th className="px-3 py-3">KAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {dataAll.data.length > 0 ? (
                                            dataAll.data.map((item, index) => (
                                                <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700" key={index}>
                                                    <td className="px-3 py-2">{index + 1}</td>
                                                    <td className="px-3 py-2">{item.region_name}</td>
                                                    <td className="px-3 py-2">{item.branch_name}</td>
                                                    <td className="px-3 py-2">{item.full_name}</td>
                                                    <td className="px-3 py-2">{item.nik}</td>
                                                    <td className="px-3 py-2">{item.kat_name || 'N/A'}</td>
                                                </tr>
                                            ))
                                        ) : (
                                            <tr>
                                                <td colSpan="6" className="px-3 py-2 text-center">No data found.</td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>
                            {/* Render pagination only if links exist */}
                            {dataAll.links && (
                                <Pagination links={dataAll.links} />
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

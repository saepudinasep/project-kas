import Pagination from "@/Components/Pagination";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Index({ auth, cmos, success }) {  // Updated here

    console.log(cmos);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Employees
                    </h2>
                    <Link
                        href={route("employee.create")}
                        className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                    >
                        Add New
                    </Link>
                </div>
            }
        >
            <Head title="Employees" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {success && (
                        <div className="bg-emerald-500 py-2 px-4 text-white rounded mb-4">
                            {success}
                        </div>
                    )}
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="overflow-auto">
                                <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                                        <tr className="text-nowrap">
                                            <th className="px-3 py-3">NO</th>
                                            <th className="px-3 py-3">NIK</th>
                                            <th className="px-3 py-3">Name</th>
                                            <th className="px-3 py-3 text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {cmos && cmos.data && cmos.data.length > 0 ? (
                                            cmos.data.map((cmo, index) => (
                                                <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700" key={cmo.id}>
                                                    <td className="px-3 py-2">{index + 1}</td> {/* Updated NO */}
                                                    <td className="px-3 py-2">{cmo.nik}</td>
                                                    <td className="px-3 py-2">
                                                        <Link href={route('employee.show', cmo.id)}
                                                            className="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">
                                                            {cmo.name}
                                                        </Link>
                                                    </td>
                                                    <td className="px-3 py-2 text-right">
                                                        <Link href={route('employee.edit', cmo.id)}
                                                            className="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">
                                                            Edit
                                                        </Link>
                                                    </td>
                                                </tr>
                                            ))
                                        ) : (
                                            <tr>
                                                <td colSpan="4" className="px-3 py-2 text-center">No employees found.</td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>
                            {cmos && cmos.links && (
                                <Pagination links={cmos.links} />
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}

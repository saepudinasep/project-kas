import Pagination from "@/Components/Pagination";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router } from "@inertiajs/react";

export default function IndexMSP({ auth, branches, success }) {  // Updated here

    console.log(branches);

    const deleteRegion = (branch) => {
        if (!window.confirm("Are you sure you want to delete the branch?")) {
            return;
        }
        router.delete(route("branch.destroy", branch.id))
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Regions
                    </h2>
                    <Link
                        href={route("branch.create")}
                        className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                    >
                        Add New
                    </Link>
                </div>
            }
        >
            <Head title="Regions" />

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
                                            <th className="px-3 py-3">Region Name</th>
                                            <th className="px-3 py-3">Branch Name</th>
                                            <th className="px-3 py-3 text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {branches && branches.data && branches.data.length > 0 ? (
                                            branches.data.map((branch, index) => (
                                                <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700" key={branch.id}>
                                                    <td className="px-3 py-2">{index + 1}</td> {/* Updated NO */}
                                                    <td className="px-3 py-2">{branch.region.name}</td>
                                                    <td className="px-3 py-2">{branch.name}</td>
                                                    <td className="px-3 py-2 text-right">
                                                        <Link href={route('branch.edit', branch.id)}
                                                            className="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-1">
                                                            Edit
                                                        </Link>
                                                        <button onClick={(e) => deleteRegion(branch)} className="font-medium text-red-600 dark:text-red-500 hover:underline mx-1">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))
                                        ) : (
                                            <tr>
                                                <td colSpan="4" className="px-3 py-2 text-center">No Regions found.</td>
                                            </tr>
                                        )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                {branches && branches.links && (
                    <Pagination links={branches.links} />
                )}
            </footer>
        </AuthenticatedLayout>
    )
}

import { useForm, Head, Link } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function AddKat({ auth, cmo, availableKats, success }) {

    console.log(availableKats);

    const { data, setData, post, errors } = useForm({
        kat_ids: [],
    });

    const handleCheckboxChange = (e) => {
        const value = parseInt(e.target.value);
        let updatedKatIds = [...data.kat_ids];

        if (e.target.checked) {
            updatedKatIds.push(value);
        } else {
            updatedKatIds = updatedKatIds.filter(id => id !== value);
        }

        setData('kat_ids', updatedKatIds);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('employee.storeKat', cmo.id));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Add Kat for {cmo.name}
                    </h2>
                    <Link
                        href={route("employee.show", cmo.id)}
                        className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                    >
                        Back
                    </Link>
                </div>
            }
        >
            <Head title="Add Kat" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {success && (
                        <div className="bg-emerald-500 py-2 px-4 text-white rounded mb-4">
                            {success}
                        </div>
                    )}
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <form onSubmit={handleSubmit}>
                                <div className="overflow-auto">
                                    <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-gray-500">
                                            <tr>
                                                <th className="px-3 py-3">Select</th>
                                                <th className="px-3 py-3">KAT Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {availableKats.length > 0 ? (
                                                availableKats.map(kat => (
                                                    <tr key={kat.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td className="px-3 py-2">
                                                            <input
                                                                type="checkbox"
                                                                value={kat.id}
                                                                onChange={handleCheckboxChange}
                                                            />
                                                        </td>
                                                        <td className="px-3 py-2">{kat.name}</td>
                                                    </tr>
                                                ))
                                            ) : (
                                                <tr>
                                                    <td colSpan="2" className="px-3 py-2 text-center">No Kats available.</td>
                                                </tr>
                                            )}
                                        </tbody>
                                    </table>
                                </div>
                                {errors.kat_ids && (
                                    <div className="text-red-500 text-sm mt-2">{errors.kat_ids}</div>
                                )}
                                <div className="mt-4">
                                    <button
                                        type="submit"
                                        className="bg-blue-500 text-white py-2 px-4 rounded"
                                    >
                                        Add Kat
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

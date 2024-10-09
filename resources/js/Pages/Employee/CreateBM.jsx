import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import SelectInput from "@/Components/SelectInput";
import TextInput from "@/Components/TextInput";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function CreateBM({ auth, regions, branches }) {
    const { data, setData, post, errors, reset } = useForm({
        region_id: "",
        branch_id: "",
        nik: "",
        name: "",
    });

    // State for managing branches
    const [filteredBranches, setFilteredBranches] = useState([]);
    const [isBranchDisabled, setIsBranchDisabled] = useState(true);

    // Handle Region change and filter branches
    const handleRegionChange = (e) => {
        const selectedRegionId = e.target.value;
        setData("region_id", selectedRegionId);

        // Filter branches based on the selected region
        const filtered = branches.filter(
            (branch) => branch.region_id === parseInt(selectedRegionId)
        );
        setFilteredBranches(filtered);

        // Enable the branch select input if a region is selected
        setIsBranchDisabled(selectedRegionId === "");
    };

    const onSubmit = (e) => {
        e.preventDefault();
        post(route("employee.store"));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Create New Employee
                    </h2>
                </div>
            }
        >
            <Head title="Employees" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <form
                            onSubmit={onSubmit}
                            className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                        >
                            {/* Region Dropdown */}
                            <div className="mt-4">
                                <InputLabel htmlFor="region_id" value="Region" />
                                <SelectInput
                                    id="region_id"
                                    name="region_id"
                                    className="mt-1 block w-full"
                                    onChange={handleRegionChange}
                                >
                                    <option value="">Select Region</option>
                                    {regions.map((region) => (
                                        <option value={region.id} key={region.id}>
                                            {region.name}
                                        </option>
                                    ))}
                                </SelectInput>
                                <InputError message={errors.region_id} className="mt-2" />
                            </div>

                            {/* Branch Dropdown */}
                            <div className="mt-4">
                                <InputLabel htmlFor="branch_id" value="Branch" />
                                <SelectInput
                                    id="branch_id"
                                    name="branch_id"
                                    className="mt-1 block w-full"
                                    disabled={isBranchDisabled} // Disable when no region selected
                                    onChange={(e) => setData("branch_id", e.target.value)}
                                >
                                    <option value="">Select Branch</option>
                                    {filteredBranches.map((branch) => (
                                        <option value={branch.id} key={branch.id}>
                                            {branch.name}
                                        </option>
                                    ))}
                                </SelectInput>
                                <InputError message={errors.branch_id} className="mt-2" />
                            </div>

                            {/* NIK Input */}
                            <div className="mt-4">
                                <InputLabel htmlFor="nik" value="NIK" />
                                <TextInput
                                    id="nik"
                                    type="number"
                                    name="nik"
                                    value={data.nik}
                                    className="mt-1 block w-full"
                                    isFocused={true}
                                    onChange={(e) => setData("nik", e.target.value)}
                                />
                                <InputError message={errors.nik} className="mt-2" />
                            </div>

                            {/* Name Input */}
                            <div className="mt-4">
                                <InputLabel htmlFor="name" value="Full Name" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    name="name"
                                    value={data.name}
                                    className="mt-1 block w-full"
                                    onChange={(e) => setData("name", e.target.value)}
                                />
                                <InputError message={errors.name} className="mt-2" />
                            </div>

                            {/* Submit Button */}
                            <div className="mt-4 text-right">
                                <Link
                                    href={route("employee.index")}
                                    className="bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all hover:bg-gray-200 mr-2"
                                >
                                    Cancel
                                </Link>
                                <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
